<div upload-file <?= $this->expandAttributes($this->options) ?>>

    <!-- data -->
    <data name="file_type" class="hide"><?= $this->getFileType(); ?></data>
    <data name="repo_path" class="hide"><?= base64_encode(Setting::get('repo.path')); ?></data>
    <data name="value" class="hide"><?= $this->value; ?></data>
    <data name="name" class="hide"><?= $this->name; ?></data>
    <data name="mode" class="hide"><?= $this->mode; ?></data>
    <data name="options" class="hide"><?= json_encode($this->options); ?></data>
    <data name="class_alias" class="hide"><?= Helper::classAlias($model) ?></data>
    <data name="allow_delete" class="hide"><?= $this->allowDelete; ?></data>
    <data name="allow_overwrite" class="hide"><?= $this->allowOverwrite; ?></data>

    <!-- /data -->

    <!-- label -->
    <?php if ($this->label != ""): ?>
        <label <?= $this->expandAttributes($this->labelOptions) ?>
            class="<?= $this->labelClass ?>" for="<?= $this->name; ?>">
                <?= $this->label ?>
        </label>
    <?php endif; ?>
    <!-- /label -->


    <div class="<?= $this->fieldColClass ?>">
        <input type="hidden"
               id="<?= $this->renderID ?>"
               name="<?= $this->renderName ?>" 
               ng-value="value"
               />
        <div ng-if="mode != 'Download Only' && (allowOverwrite == 'Yes' || allowOverwrite == 'No' && file === null)" >
            <div ng-if="mode == 'Upload + Browse + Download' && choosing == ''" class="form-control" style="height:auto;padding-top:0px;padding-bottom:0px;">
                <div style="margin:3px -6px;" class="btn btn-success btn-xs" ng-click="choose('Browse')">
                    <i class="fa fa-folder-open"></i>   Browse Repository
                </div>
                <label for="<?= $this->renderID . "inf" ?>" style="margin:3px -6px;" 
                       class="btn btn-default pull-right btn-xs" ng-click="choose('Upload')">
                    <i class="fa fa-upload"></i> Upload File
                </label>
                <div class="clearfix"></div>
            </div>

            <div ng-if="choosing == 'Browse'">
                <div ng-show="choosing == 'Browse' && mode == 'Upload + Browse + Download'"
                     class=" pull-right">
                    <div class="btn btn btn-xs btn-danger"
                         ng-click="choose('')"
                         style="position:absolute;margin:4px 0px 0px -28px;">
                        <i class="fa fa-rotate-left"></i>
                    </div>
                </div>
                <div class="form-control">
                    <div style="margin:-2px 0px 0px -7px;" class="btn btn-xs" ng-click="choose('Browse')">
                        <i class="fa fa-folder-open"></i>   Browse Repository
                    </div>
                </div>
            </div>

            <div class="upload-field-internal" ng-if="choosing == 'Upload' || mode.indexOf('Upload') >= 0">    
                <div ng-show="choosing == 'Upload' && mode == 'Upload + Browse + Download'"
                     class=" pull-right">
                    <div class="btn btn btn-xs btn-danger"
                         ng-click="choose('')"
                         style="position:absolute;margin:4px 0px 0px -28px;">
                        <i class="fa fa-rotate-left"></i>
                    </div>
                </div>

                <input id="<?= $this->renderID . "inf" ?>"
                       ng-show="choosing == 'Upload' || mode != 'Upload + Browse + Download'" 
                       type="file" <?= $this->expandAttributes($this->fieldOptions) ?> 
                       ng-file-select="onFileSelect($files)" onclick="this.value = null"/>
            </div>

            <div class="form-control" 
                 style="padding:5px 5px 5px 5px;
                 margin-top: -2px;
                 height: auto;
                 border-top-left-radius: 0px;
                 border-top-right-radius: 0px;
                 height:auto;" 
                 ng-if="file !== null || loading">
                <div ng-if="loading">
                    <div ng-hide="progress >= 0 && progress <= 100">
                        <i class="fa fa-refresh fa-spin" style="margin-right:6px;"></i><b>Loading...</b>
                    </div>
                    <div class="progress" ng-show="progress >= 0 && progress <= 100" 
                         style="margin:0px auto -2px auto;width:100%">
                        <div class="progress-bar" 
                             role="progressbar" style="width:{{progress}}%;">
                            Uploading {{progress}}%
                        </div>
                    </div>
                </div>
                <!--                <div style="margin:0px -5px;">
                                    <div class="file-desc-loading label label-success"
                                         ng-if="fileDescLoadText"
                                         style="position:absolute; 
                                         font-weight:normal;
                                         right:24px; 
                                         font-size:11px;
                                         margin-top:3px; 
                                         padding:2px 3px;
                                         opacity:.5;
                                         border-radius:0px;
                                         text-align:right;">
                                        {{fileDescLoadText}}
                                    </div>
                                    <textarea auto-grow ng-if="!loading && file !== null" ng-model="json" 
                                              style="min-width:100%;max-width:100%;font-size:12px;"
                                              placeholder="File Description"
                                              ng-change="saveDesc(json)" ng-delay="300">
                                    </textarea>
                                </div>-->

                <div ng-if="!loading && file !== null">
                    <a  href="{{ Yii.app.createUrl('/formfield/UploadFile.download', {
                            f: file.downloadPath,
                            n: file.name
                        })}}" class="btn btn-xs btn-success pull-right">
                        Download
                    </a>
                    <div class="btn btn-xs btn-danger pull-right" style="margin-right:5px"
                         ng-if="allowDelete == 'Yes'" ng-click="remove(file.downloadPath)">
                        Remove
                    </div>
                    <div style="word-wrap: break-word;width:50%;float:left;">
                        {{ formatName(file.name) | elipsisMiddle:25}}
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div ng-if="mode == 'Download Only' || (allowOverwrite == 'No' && file !== null)" class="form-control"
             style="padding:5px 5px 2px 0px;">
            <div ng-if="file.name">
                <i class="fa fa-nm {{file.type}} pull-left" 
                   style="margin:2px 6px 0px 6px;"></i>
                <div style="word-wrap: break-word;width:50%;float:left;">
                    {{ formatName(file.name) | elipsisMiddle:30}}
                </div>

                <a  href="{{ Yii.app.createUrl('/formfield/UploadFile.download', {
                                f: file.downloadPath,
                                n: file.name
                            })}}" class="btn btn-xs btn-success pull-right" style="margin-top:-2px;">
                    Download
                </a>
                <div class="btn btn-xs btn-danger pull-right" style="margin-right:5px;margin-top:-2px;"
                     ng-if="allowDelete == 'Yes'" ng-click="remove(file.path)">
                    Remove
                </div>
                <div class="clearfix"></div>
                <div style="font-size:12px;color:#999;">{{ json}}</div>
            </div>
            <div ng-if="!file.name" style="font-size:12px;color:#999;text-align:center;">
                &mdash; EMPTY &mdash;
            </div>
        </div>

        <!-- error -->
        <div class="alert error alert-danger" ng-show="errors.length > 0">
            <li ng-repeat="error in errors">
                {{error}}
            </li>
        </div>
        <!-- /error -->
    </div>

    <?php
    echo FormBuilder::build('RepoBrowser', [
        'name' => 'BrowseDialog',
        'showBrowseButton' => 'No',
    ]);
    ?>

</div>