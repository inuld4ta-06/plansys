app.directive('psDataFilter', function($timeout, dateFilter) {
    return {
        scope: true,
        compile: function(element, attrs, transclude) {
            //hide filter criteria when mouse is clicked outside
            $(document).mouseup(function(e) {
                var container = $(".filter-criteria");
                if (!container.is(e.target) && container.parent().has(e.target).length === 0) {
                    container.hide().removeClass('open');
                    $(".filter-criteria-button").removeClass('active');
                }
            });

            return function($scope, $el, attrs, ctrl) {
                /************* All Filter **************/
                $scope.toggleFilterCriteria = function(e) {
                    var parent = $(e.target).parents('.btn-group');
                    var btn = parent.find('.filter-criteria-button');
                    if (parent.find("> .filter-criteria").hasClass('open')) {
                        parent.find("> .filter-criteria").removeClass('open');
                        parent.find("> .filter-criteria").hide();
                        btn.removeClass('active');
                    } else {
                        // hide another filter criteria
                        $(".filter-criteria").hide().removeClass('open');
                        $(".filter-criteria-button").removeClass('active');
                        btn.addClass('active');

                        // show current filter criteria
                        parent.find("> .filter-criteria").addClass('open');
                        parent.find("> .filter-criteria").show();
                        parent.find('.focused').focus();

                        // reposition filter criteria
                        var container_width = parent.parents('.container-full').width();
                        var parent_left = parent.find("> .filter-criteria").offset().left;
                        var parent_width = parent.find("> .filter-criteria").width();

                        if (parent_left + parent_width > container_width) {
                            var margin_left = parent_left + parent_width - container_width + 50;
                            parent.find("> .filter-criteria").css('margin-left', "-" + margin_left + "px");
                            $scope.toggleFilterCriteria(e);
                            $scope.toggleFilterCriteria(e);
                        }
                    }
                }

                $scope.resetFilter = function(filter) {
                    filter.value = '';
                    if (filter.filterType == 'date') {
                        filter.from = '';
                        filter.to = '';
                    }

                    filter.operator = $scope.operators[filter.filterType][0];
                    $scope.changeValueText(filter);

                    var ds = $scope.$parent[$scope.datasource];
                    var dsParamName = "";
                    for (i in ds.params) {
                        if (ds.params[i] == $scope.name) {
                            dsParamName = i;
                        }
                    }

                    if (dsParamName != "") {
                        ds.resetParam(filter.name, dsParamName);
                        ds.query(function() {
                        });
                    }
                }

                $scope.initFilters = function(filters) {
                    for (i in filters) {
                        var f = filters[i];
                        f.value = '';
                        f.show = true;
                        f.valueText = 'All';
                        f.operatorDropdownOpen = false;
                        f.operator = $scope.operators[f.filterType][0];

                        if (f.filterType == 'list' || f.filterType == 'check') {
                            f.list = $scope.renderFormList(f.list);
                            f.searchable = false;
                            f.search = '';

                            if (f.filterType == 'check') {
                                f.checked = [];
                                for (i in f.list) {
                                    if (angular.isObject(f.list[i].value)) {
                                        for (k in f.list[i].value) {
                                            if (f.list[i].value[k].key == '---')
                                                continue;
                                            f.checked.push(f.list[i].value[k].key);
                                        }
                                    } else {
                                        if (f.list[i].key == '---')
                                            continue;
                                        f.checked.push(f.list[i].key);
                                    }
                                }
                                f.checkedLength = f.checked.length;
                            }
                            // todo: fix search focus
                        }
                    }
                    return filters;
                }

                $scope.updateFilter = function(filter, e) {
                    $scope.changeValueText(filter);

                    if (filter.filterType != 'list' && filter.filterType != 'check') {
                        $scope.toggleFilterCriteria(e);
                    }

                    var ds = $scope.$parent[$scope.datasource];
                    var dsParamName = "";

                    for (i in ds.params) {
                        if (ds.params[i] == $scope.name) {
                            dsParamName = i;
                        }
                    }

                    if (dsParamName != "") {
                        ds.updateParam(filter.name, {
                            value: filter.value,
                            operator: filter.operator,
                            type: filter.filterType
                        }, dsParamName);

                        ds.query(function() {
                        })
                    }
                }

                /************** Filter Dropdown ***************/
                $scope.listFound = function(input, filter) {
                    return filter.search == '' || input.toLowerCase().indexOf(filter.search.toLowerCase()) > -1;
                }

                $scope.isObject = function(input) {
                    return angular.isObject(input);
                }

                $scope.listSearch = function(el) {
                    $el = $(el.target);
                    $timeout(function() {
                        $el.find("li.hover").removeClass("hover");
                        $el.find("li:not(.ng-hide):first").addClass("hover");
                    }, 0);
                };

                $scope.toggleShowFilter = function(filter) {
                    filter.show = (filter.show ? false : true);
                }

                $scope.updateDropdown = function(e, filter, value) {
                    filter.value = value.key;
                    filter.dropdownText = value.value;

                    if (filter.filterType == 'check') {
                        e.stopPropagation();
                        e.preventDefault();

                        var index = filter.checked.indexOf(filter.value);

                        if (index >= 0) {
                            filter.checked.splice(index, 1);
                        } else {
                            filter.checked.push(filter.value);
                        }

                        filter.value = filter.checked;
                    }

                    $scope.updateFilter(filter, e);
                }

                $scope.dropdownChecked = function(filter, item) {
                    if (filter.valueText == 'All') {
                        return true;
                    } else if (filter.checked.indexOf(item.key) >= 0) {
                        return true;
                    } else {
                        return false;
                    }
                }

                $scope.renderFormList = function(list) {
                    var newList = [];
                    for (key in list) {
                        if (angular.isObject(list[key])) {
                            var subItem = [];
                            var rawSub = list[key];
                            for (subkey in rawSub) {
                                subItem.push({key: subkey, value: rawSub[subkey]});
                            }
                            newList.push({key: key, value: subItem});
                        } else {
                            newList.push({key: key, value: list[key]});
                        }
                    }
                    return newList
                }

                /*************** Filter Text *************/
                $scope.focused = function(e) {
                    $(e.target).parents('.input-group').find('.focused').focus();
                }

                $scope.filterValueKeydown = function(filter, e) {
                    switch (e.which) {
                        case 13:
                            e.preventDefault();
                            e.stopPropagation();
                            $scope.updateFilter(filter, e);
                            break;
                    }
                }

                $scope.changeValueText = function(filter) {

                    if (filter.operator == 'Is Empty') {
                        filter.valueText = 'Is Empty';
                    } else if (filter.value == '') {
                        filter.valueText = 'All';
                    } else {
                        switch (filter.filterType) {
                            case "list":
                                filter.valueText = filter.dropdownText;
                                break;
                            case "check":
                                if (filter.checked.length == filter.checkedLength) {
                                    filter.valueText = 'All';
                                } else {
                                    filter.valueText = filter.checked.join(", ");
                                }
                                break;
                            case "string":
                                filter.valueText = filter.operator + " [" + filter.value + "]";
                                break;
                            case "number":
                                filter.valueText = filter.operator + " " + filter.value;
                                break;
                            case "date":
                                var from = dateFilter(filter.from, 'dd/MM/yyyy');
                                if (typeof from == "undefined") {
                                    from = "";
                                }

                                var to = dateFilter(filter.to, 'dd/MM/yyyy');
                                if (typeof to == "undefined") {
                                    to = "";
                                }
                                switch (filter.operator) {
                                    case "Between":
                                        filter.valueText = filter.operator + " " + from + " - " + to;
                                        break;
                                    case "Not Between":
                                        filter.valueText = filter.operator + " " + from + " - " + to;
                                        break;
                                    case "Less Than":
                                        filter.valueText = filter.operator + " " + to;
                                        break;
                                    case "More Than":
                                        filter.valueText = filter.operator + " " + from;
                                        break;
                                }
                        }


                    }
                }

                /************** Filter Date *************/
                $scope.changeOperator = function(filter, operator, e) {
                    filter.operator = operator;
                    filter.operatorDropdownOpen = false;
                    $scope.focused(e);

                    $scope.changeValueText(filter, filter.value);
                }

                $scope.changeValueFromDate = function(filter, from) {
                    filter[from + "Open"] = false;
                    $timeout(function() {
                        filter.value = {
                            from: dateFilter(filter.from, 'yyyy-MM-dd HH:mm:00'),
                            to: dateFilter(filter.to, 'yyyy-MM-dd HH:mm:00')
                        };
                    }, 0);
                }

                $scope.focusDatePicker = function(filter, from) {
                    filter[from + "Open"] = true;
                }


                $scope.operators = JSON.parse($el.find("data[name=operators]").text());
                $scope.filters = $scope.initFilters(JSON.parse($el.find("data[name=filters]").text()));
                $scope.datasource = $el.find("data[name=datasource]").text();
                $scope.name = $el.find("data[name=name]").text();
                $scope.dateOptions = {
                    'show-weeks': false
                };
                $scope.filterTemplate = {
                    string: 'filter_text',
                    number: 'filter_text',
                    list: 'filter_dropdown',
                    check: 'filter_dropdown',
                    date: 'filter_date'
                }
            }
        }
    };
});