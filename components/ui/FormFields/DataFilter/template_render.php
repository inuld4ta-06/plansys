<div ps-data-filter class="data-filter">
    <data name="filters" class="hide"><?= json_encode($this->filters); ?></data>
    <data name="operators" class="hide"><?= json_encode($this->filterOperators); ?></data>

    <script type="text/ng-template" id="filter_common"><?php include('filter_common.php'); ?></script>

    <table style="width:100%">
        <tr>
            <td class="filter-td filter-manage">
                <div class="btn-group" dropdown>
                    <button type="button" class="btn btn-sm btn-default dropdown-toggle">
                        <i class="fa fa-bars fa-nm"></i> 
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li ng-repeat="filter in filters">
                            <a href="" ng-click="toggleShowFilter(filter)">
                                <label>
                                    <input ng-checked="filter.show"
                                           type="checkbox" 
                                           name="<?= $this->name ?>_filter" value="{{filter.name}}"/>
                                    {{filter.label}}
                                </label>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
            <td class="filter-td" style="width:100%">
                <div class="filter-item-container" ng-repeat="filter in filters" ng-if="filter.show">
                    <div ng-include="filterTemplate[filter.filterType]"></div>
                </div>
            </td>
        </tr>
    </table>
    <div class="clearfix"></div>

</div>