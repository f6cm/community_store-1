<?php defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Package\CommunityStore\Src\CommunityStore\Utilities\Image;
use \Concrete\Core\Support\Facade\Url;
use \Concrete\Core\Support\Facade\Config;

$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
?>

<div class="ccm-dashboard-header-buttons">
    <a href="<?= Url::to('/dashboard/store/settings/shipping'); ?>" class="btn btn-primary"><i class="fa fa-truck fa-flip-horizontal"></i> <?= t("Shipping Methods"); ?></a>
    <a href="<?= Url::to('/dashboard/store/settings/tax'); ?>" class="btn btn-primary"><i class="fa fa-money"></i> <?= t("Tax Rates"); ?></a>
</div>

<form method="post">
    <?= $token->output('community_store'); ?>

    <div class="row">
        <div class="col-sm-3">

            <ul class="nav nav-pills nav-stacked flex-column">
                <li class="nav-item active"><a class="nav-link text-primary"" href="#settings-currency" data-pane-toggle><?= t('Currency'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-tax" data-pane-toggle><?= t('Tax'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-shipping" data-pane-toggle><?= t('Shipping'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-payments" data-pane-toggle><?= t('Payments'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-order-statuses" data-pane-toggle><?= t('Fulfilment Statuses'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-notifications" data-pane-toggle><?= t('Notifications and Receipts'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-customers" data-pane-toggle><?= t('Customers'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-products" data-pane-toggle><?= t('Products'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-product-images" data-pane-toggle><?= t('Product Images'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-digital-downloads" data-pane-toggle><?= t('Digital Downloads'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-checkout" data-pane-toggle><?= t('Cart and Checkout'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-orders" data-pane-toggle><?= t('Orders'); ?></a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#settings-user-interface" data-pane-toggle><?= t('User Interface'); ?></a></li>
            </ul>

        </div>

        <div class="col-sm-9 store-pane active" id="settings-currency">
            <h3><?= t('Currency Settings'); ?></h3>

            <div class="row">
                <div class="form-group col-md-4">
                    <?= $form->label('currency', t('Currency')); ?>

                    <?php
                    $currencies = ['' => '-- ' . t('Unspecified') . ' --'];
                    $currencyList = array_merge($currencies, $currencyList);
                    ?>

                    <?= $form->select('currency', $currencyList, Config::get('community_store.currency')); ?>
                </div>
            </div>

            <div id="extra-currency" class="row <?= (Config::get('community_store.currency') ? 'hidden' : ''); ?>">
                <div class="form-group col-md-4">
                    <?= $form->label('symbol', t('Currency Symbol')); ?>
                    <?= $form->text('symbol', Config::get('community_store.symbol')); ?>
                </div>
                <div class="form-group col-md-4">
                    <?= $form->label('thousand', t('Thousands Separator')); ?>
                    <?= $form->text('thousand', Config::get('community_store.thousand')); ?>
                    <p class="help-block"><?= t('e.g. , or a space'); ?></p>
                </div>
                <div class="form-group col-md-4">
                    <?= $form->label('whole', t('Whole Number Separator')); ?>
                    <?= $form->text('whole', Config::get('community_store.whole')); ?>
                    <p class="help-block"><?= t('e.g. period or a comma'); ?></p>
                </div>
            </div>

            <script>
                $(function () {
                    $('#currency').change(function () {
                        if ($(this).val()) {
                            $('#extra-currency').addClass('hidden');
                        } else {
                            $('#extra-currency').removeClass('hidden');
                        }
                    });

                });
            </script>

        </div><!-- #settings-currency -->

        <div class="col-sm-9 store-pane" id="settings-tax">
            <h3><?= t('Tax Settings'); ?></h3>

            <div class="form-group">
                <?= $form->label('calculation', t('Are Prices Entered with Tax Included?')); ?>
                <?= $form->select('calculation', ['add' => t("No, I will enter product prices EXCLUSIVE of tax"), 'extract' => t("Yes, I will enter product prices INCLUSIVE of tax")], Config::get('community_store.calculation')); ?>
            </div>

            <div class="form-group">
                <?= $form->label('vat_number', t('Enable EU VAT Number Options?')); ?>
                <?= $form->select('vat_number', ['0' => t("No, I don't need this"), '1' => t("Yes, enable VAT Number options")], Config::get('community_store.vat_number')); ?>
            </div>

        </div>

        <div class="col-sm-9 store-pane" id="settings-shipping">

            <h3><?= t("Shipping Units"); ?></h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->label('weightUnit', t('Units for Weight')); ?>
                        <?php ?>
                        <?= $form->select('weightUnit', ['oz' => t('oz'), 'lb' => t('lb'), 'kg' => t('kg'), 'g' => t('g')], Config::get('community_store.weightUnit')); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->label('sizeUnit', t('Units for Size')); ?>
                        <?php ?>
                        <?= $form->select('sizeUnit', ['in' => t('in'), 'cm' => t('cm'), 'mm' => t('mm')], Config::get('community_store.sizeUnit')); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="checkbox form-check">
                    <label><?= $form->checkbox('deliveryInstructions', '1', Config::get('community_store.deliveryInstructions') ? '1' : '0'); ?>
                        <?= t('Include Delivery Instructions field in checkout'); ?></label>
                    </div>
                </div>
            </div>

            <h3><?= t("Multiple Packages Support"); ?></h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="checkbox form-check">
                    <label><?= $form->checkbox('multiplePackages', '1', Config::get('community_store.multiplePackages') ? '1' : '0'); ?>
                        <?= t('Enable Package(s) Data fields'); ?></label>
                    </div>
                    <p class="help-block"> <?= t('Allows multiple packages to be defined per product configuration, to be used by advanced shipping methods'); ?></p>
                </div>
            </div>


        </div><!-- #settings-shipping -->

        <div class="col-sm-9 store-pane" id="settings-payments">
            <h3><?= t("Payment Methods"); ?></h3>
            <?php
            if ($installedPaymentMethods) {
                foreach ($installedPaymentMethods as $pm) {
                    ?>

                    <div class="panel panel-default card mb-3">

                        <div class="panel-heading card-heading ps-3 pt-3 heading fs-4"><?= t($pm->getName()); ?></div>

                        <div class="panel-body card-body pb-0">

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group paymentMethodEnabled">
                                        <input type="hidden" name="paymentMethodHandle[<?= $pm->getID(); ?>]" value="<?= $pm->getHandle(); ?>">
                                        <?= $form->label("paymentMethodEnabled[" . $pm->getID() . "]", t("Enabled")); ?>
                                        <?php
                                        echo $form->select("paymentMethodEnabled[" . $pm->getID() . "]", [0 => t("No"), 1 => t("Yes")], $pm->isEnabled()); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?= $form->label("paymentMethodSortOrder[" . $pm->getID() . "]", t("Sort Order")); ?>
                                        <?= $form->number('paymentMethodSortOrder[' . $pm->getID() . ']', $pm->getSortOrder()); ?>
                                    </div>
                                </div>

                            </div>

                            <div class="paymentConfigDetails" id="paymentMethodForm-<?= $pm->getID(); ?>" style="display:<?= $pm->isEnabled() ? 'block' : 'none'; ?>">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <?= $form->label("paymentMethodDisplayName[" . $pm->getID() . "]", t("Display Name (on checkout)")); ?>
                                        <?= $form->text('paymentMethodDisplayName[' . $pm->getID() . ']', $pm->getDisplayName()); ?>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <?= $form->label("paymentMethodButtonLabel[" . $pm->getID() . "]", t("Button Label")); ?>
                                        <?= $form->text('paymentMethodButtonLabel[' . $pm->getID() . ']', $pm->getButtonLabel(), ['placeholder' => t('Optional')]); ?>
                                    </div>
                                </div>
                                <?php
                                $pm->renderDashboardForm(); ?>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= $form->label("paymentMethodUserGroups[" .  $pm->getID() . "]", t("Available To User Groups")); ?>
                                            <div class="ccm-search-field-content ccm-search-field-content-select2">
                                                <select multiple="multiple" name="paymentMethodUserGroups[<?= $pm->getID(); ?>][]" id="groupselect-<?= $pm->getID(); ?>" class="selectize" style="width: 100%;" placeholder="<?= t('All User Groups'); ?>">
                                                    <?php
                                                    foreach ($allGroupList as $ugkey => $uglabel) { ?>
                                                        <option value="<?= $ugkey; ?>" <?= (in_array($ugkey, $pm->getUserGroups()) ? 'selected="selected"' : ''); ?>>  <?= $uglabel; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= $form->label("paymentMethodExcludedUserGroups[" .  $pm->getID() . "]", t("Exclude From User Groups")); ?>
                                            <div class="ccm-search-field-content ccm-search-field-content-select2">
                                                <select multiple="multiple" name="paymentMethodExcludedUserGroups[<?= $pm->getID(); ?>][]" id="groupexcludeselect-<?= $pm->getID(); ?>" class="selectize" style="width: 100%;" placeholder="<?= t('None'); ?>">
                                                    <?php
                                                    foreach ($allGroupList as $ugkey => $uglabel) { ?>
                                                        <option value="<?= $ugkey; ?>" <?= (in_array($ugkey, $pm->getExcludedUserGroups()) ? 'selected="selected"' : ''); ?>>  <?= $uglabel; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <?php

                }
            } else {
                echo t("No Payment Methods are Installed");
            }
            ?>

            <script>
                $(function () {
                    $('.paymentMethodEnabled SELECT').on('change', function () {
                        var $this = $(this);
                        if ($this.val() == 1) {
                            $this.closest('.panel-body').find('.paymentConfigDetails').slideDown();
                        } else {
                            $this.closest('.panel-body').find('.paymentConfigDetails').slideUp();
                        }
                    });
                });
            </script>
        </div><!-- #settings-payments -->

        <div class="col-sm-9 store-pane" id="settings-order-statuses">
            <h3><?= t("Fulfilment Statuses"); ?></h3>
            <?php
            if (count($orderStatuses) > 0) {
                ?>
                <div class="panel panel-default card">

                    <table class="table" id="orderStatusTable">
                        <thead>
                        <tr>
                            <th rowspan="1">&nbsp;</th>
                            <th rowspan="1"><?= t('Display Name'); ?></th>
                            <th rowspan="1"><?= t('Default Status'); ?></th>
                            <th colspan="2" style="display:none;"><?= t('Send Change Notifications to...'); ?></th>
                        </tr>
                        <tr style="display:none;">
                            <th><?= t('Site'); ?></th>
                            <th><?= t('Customer'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orderStatuses as $orderStatus) {
                            ?>
                            <tr>
                                <td class="sorthandle"><input type="hidden" name="osID[]" value="<?= $orderStatus->getID(); ?>"><i class="fa fa-arrows-v fa-arrows-alt-v"></i></td>
                                <td><input type="text" name="osName[]" value="<?= t($orderStatus->getName()); ?>" placeholder="<?= $orderStatus->getReadableHandle(); ?>" class="form-control ccm-input-text"></td>
                                <td><input type="radio" name="osIsStartingStatus" value="<?= $orderStatus->getID(); ?>" <?= $orderStatus->isStartingStatus() ? 'checked' : ''; ?>></td>
                                <td style="display:none;"><input type="checkbox" name="osInformSite[]" value="1" <?= $orderStatus->getInformSite() ? 'checked' : ''; ?> class="form-control"></td>
                                <td style="display:none;"><input type="checkbox" name="osInformCustomer[]" value="1" <?= $orderStatus->getInformCustomer() ? 'checked' : ''; ?> class="form-control"></td>
                            </tr>
                            <?php

                        } ?>
                        </tbody>
                    </table>
                    <script>
                        $(function () {
                            $('#orderStatusTable TBODY').sortable({
                                cursor: 'move',
                                opacity: 0.5,
                                handle: '.sorthandle'
                            });

                        });
                    </script>

                </div>

                <?php

            } else {
                echo t("No Fulfilment Statuses are available");
            }
            ?>


        </div><!-- #settings-order-statuses -->

        <div class="col-sm-9 store-pane" id="settings-notifications">
            <h3><?= t('Notification Emails'); ?></h3>

            <div class="form-group">
                <?= $form->label('notificationEmails', t('Send order notification to email')); ?>
                <?= $form->text('notificationEmails', Config::get('community_store.notificationemails'), ['placeholder' => t('Email Address')]); ?>
                <p class="help-block"><?= t('separate multiple emails with commas'); ?></p>
            </div>

            <h4><?= t('Emails Sent From'); ?></h4>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->label('emailAlert', t('From Email')); ?>
                        <?= $form->email('emailAlert', Config::get('community_store.emailalerts'), ['placeholder' => t('From Email Address')]); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->label('emailAlertName', t('From Name')); ?>
                        <?= $form->text('emailAlertName', Config::get('community_store.emailalertsname'), ['placeholder' => t('From Name')]); ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label><?= $form->checkbox('setReplyTo', true, Config::get('community_store.setReplyTo')); ?>
                            <?= t('Set Reply-To on notification emails to the email address of the customer'); ?>
                        </label>
                    </div>
                </div>
            </div>

            <h3><?= t('Receipt Emails'); ?></h3>

            <div class="form-group">
                <?= $form->label('receiptHeader', t('Receipt Email Header Content')); ?>
                <?php $editor = $app->make('editor');
                $editor->getPluginManager()->deselect(['autogrow']);
                echo $editor->outputStandardEditor('receiptHeader', Config::get('community_store.receiptHeader')); ?>
            </div>

            <div class="form-group">
                <?= $form->label('receiptFooter', t('Receipt Email Footer Content')); ?>
                <?php $editor = $app->make('editor');
                $editor->getPluginManager()->deselect(['autogrow']);
                echo $editor->outputStandardEditor('receiptFooter', Config::get('community_store.receiptFooter')); ?>
            </div>

            <div class="form-group">
                <?= $form->label('receiptBCC', t('Send BCC of receipt to email')); ?>
                <?= $form->text('receiptBCC', Config::get('community_store.receiptBCC'), ['placeholder' => t('Email Address')]); ?>
                <p class="help-block"><?= t('separate multiple emails with commas'); ?></p>
            </div>


        </div>

        <!-- #settings-customers -->
        <div class="col-sm-9 store-pane" id="settings-customers">
            <h3><?= t("Customers"); ?></h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?= $form->label('customerGroup', t('Customers User Group')); ?>
                        <?= $form->select('customerGroup', $groupList, $customerGroup, ['placeholder' => t('Select a Group')]); ?>
                    </div>

                    <div class="form-group">
                        <?= $form->label('wholesaleCustomerGroup', t('Wholesale Customers User Group')); ?>
                        <?= $form->select('wholesaleCustomerGroup', $groupList, $wholesaleCustomerGroup, ['placeholder' => t('Select a Group')]); ?>
                    </div>

                    <div class="alert alert-warning">
                        <?= t("If you change group remember to switch your existing customers over to the new group"); ?>
                    </div>

                </div>
            </div>
        </div>

        <!-- #settings-products -->
        <div class="col-sm-9 store-pane" id="settings-products">
            <h3><?= t("Products"); ?></h3>
            <div class="form-group">
                <?= $form->label('productPublishTarget', t('Page to Publish Product Pages Under')); ?>
                <?= $pageSelector->selectPage('productPublishTarget', $productPublishTarget); ?>
            </div>

            <div class="form-group col-md-4">
                <label><?= t('Maximum number of product variations'); ?></label>
                <?= $form->number('variationMaxVariations', Config::get('community_store.variationMaxVariations') ?: 50, ['min' => 50, 'max' => 150]) ?>
            </div>

        </div>

        <!-- #settings-product-images -->
        <div class="col-sm-9 store-pane" id="settings-product-images">
            <h3><?= t("Product Images"); ?></h3>

            <div class="row">
                <h4 class="col-md-12"><?= t("Product Thumbnail Types"); ?></h4>
                <div class="form-group col-md-12">
                    <?= $form->label('defaultSingleProductThumbType', t('Single Product Thumbnail Type')); ?>
                    <?= $form->select('defaultSingleProductThumbType', $thumbnailTypes, Config::get('community_store.defaultSingleProductThumbType')); ?>
                </div>

                <div class="form-group col-md-12">
                    <?= $form->label('defaultProductListThumbType', t('Product List Thumbnail Type')); ?>
                    <?= $form->select('defaultProductListThumbType', $thumbnailTypes, Config::get('community_store.defaultProductListThumbType')); ?>
                </div>

                <div class="form-group col-md-12">
                    <?= $form->label('defaultProductModalThumbType', t('Product Modal Thumbnail Type')); ?>
                    <?= $form->select('defaultProductModalThumbType', $thumbnailTypes, Config::get('community_store.defaultProductModalThumbType')); ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <div class="alert alert-info small">
                        <?= t("%sThumbnail types will be used if selected because they offer better performance. %sIf they are not available for any reason, the Legacy Thumbnailer Generator set below will be used as fallback to avoid any disruption. %sReasons thumbnail types can be unavailable are if you don't select one, if it was deleted or if the image displayed doesn't have a thumbnail of the selected type.%s", '<p>', '</p><p>', '</p><p>', '</p>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="col-md-12"><?= t("Single Product - Legacy Thumbnail Generator"); ?></h4>
                <div class="form-group col-md-4">
                    <?= $form->label('defaultSingleProductImageWidth', t('Image Width')); ?>
                    <div class="input-group">
                        <?= $form->number('defaultSingleProductImageWidth', Config::get('community_store.defaultSingleProductImageWidth') ?: Image::DEFAULT_SINGLE_PRODUCT_IMG_WIDTH, ['min' => '0', 'step' => '1']); ?>
                        <div class="input-group-addon input-group-text">px</div>
                    </div>
                    <div class="help-block">
                        <?= t("Default value: %s", Image::DEFAULT_SINGLE_PRODUCT_IMG_WIDTH); ?>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <?= $form->label('defaultSingleProductImageHeight', t('Image Height')); ?>
                    <div class="input-group">
                        <?= $form->number('defaultSingleProductImageHeight', Config::get('community_store.defaultSingleProductImageHeight') ?: Image::DEFAULT_SINGLE_PRODUCT_IMG_HEIGHT, ['min' => '0', 'step' => '1']); ?>
                        <div class="input-group-addon input-group-text">px</div>
                    </div>
                    <div class="help-block">
                        <?= t("Default value: %s", Image::DEFAULT_SINGLE_PRODUCT_IMG_HEIGHT); ?>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <?= $form->label('defaultSingleProductCrop', t('Image cropping')); ?>
                    <?= $form->select('defaultSingleProductCrop', ['0' => t("Scale proportionally"), '1' => t("Scale and crop")], Config::get('community_store.defaultSingleProductCrop')); ?>
                </div>
            </div>

            <div class="row">
                <h4 class="col-md-12"><?= t("Product List - Legacy Thumbnail Generator"); ?></h4>
                <div class="form-group col-md-4">
                    <?= $form->label('defaultProductListImageWidth', t('Image Width')); ?>
                    <div class="input-group">
                        <?= $form->number('defaultProductListImageWidth', Config::get('community_store.defaultProductListImageWidth') ?: Image::DEFAULT_PRODUCT_LIST_IMG_WIDTH, ['min' => '0', 'step' => '1']); ?>
                        <div class="input-group-addon input-group-text">px</div>
                    </div>
                    <div class="help-block">
                        <?= t("Default value: %s", Image::DEFAULT_PRODUCT_LIST_IMG_WIDTH); ?>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <?= $form->label('defaultProductListImageHeight', t('Image Height')); ?>
                    <div class="input-group">
                        <?= $form->number('defaultProductListImageHeight', Config::get('community_store.defaultProductListImageHeight') ?: Image::DEFAULT_PRODUCT_LIST_IMG_HEIGHT, ['min' => '0', 'step' => '1']); ?>
                        <div class="input-group-addon input-group-text">px</div>
                    </div>
                    <div class="help-block">
                        <?= t("Default value: %s", Image::DEFAULT_PRODUCT_LIST_IMG_HEIGHT); ?>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <?= $form->label('defaultProductListCrop', t('Image cropping')); ?>
                    <?= $form->select('defaultProductListCrop', ['0' => t("Scale proportionally"), '1' => t("Scale and crop")], Config::get('community_store.defaultProductListCrop')); ?>
                </div>
            </div>

            <div class="row">
                <h4 class="col-md-12"><?= t("Product Modal - Legacy Thumbnail Generator"); ?></h4>
                <div class="form-group col-md-4">
                    <?= $form->label('defaultProductModalImageWidth', t('Image Width')); ?>
                    <div class="input-group">
                        <?= $form->number('defaultProductModalImageWidth', Config::get('community_store.defaultProductModalImageWidth') ?: Image::DEFAULT_PRODUCT_MODAL_IMG_WIDTH, ['min' => '0', 'step' => '1']); ?>
                        <div class="input-group-addon input-group-text">px</div>
                    </div>
                    <div class="help-block">
                        <?= t("Default value: %s", Image::DEFAULT_PRODUCT_MODAL_IMG_WIDTH); ?>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <?= $form->label('defaultProductModalImageHeight', t('Image Height')); ?>
                    <div class="input-group">
                        <?= $form->number('defaultProductModalImageHeight', Config::get('community_store.defaultProductModalImageHeight') ?: Image::DEFAULT_PRODUCT_MODAL_IMG_HEIGHT, ['min' => '0', 'step' => '1']); ?>
                        <div class="input-group-addon input-group-text">px</div>
                    </div>
                    <div class="help-block">
                        <?= t("Default value: %s", Image::DEFAULT_PRODUCT_MODAL_IMG_HEIGHT); ?>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <?= $form->label('defaultProductModalCrop', t('Image cropping')); ?>
                    <?= $form->select('defaultProductModalCrop', ['0' => t("Scale proportionally"), '1' => t("Scale and crop")], Config::get('community_store.defaultProductModalCrop')); ?>
                </div>
            </div>
        </div>

        <!-- #settings-digital-downloads -->
        <div class="col-sm-9 store-pane" id="settings-digital-downloads">
            <h3><?= t("Digital Downloads"); ?></h3>
            <div class="form-group">
                <?= $form->label('digitalDownloadFileSet', t('Digital Downloads File Set')); ?>
                <?= $form->select('digitalDownloadFileSet', $fileSets, $digitalDownloadFileSet, ['class' => 'selectize']); ?>
                <div class="alert alert-warning">
                    <?= t("If you change file set remember to switch your existing digital downloads over to the new file set"); ?>
                </div>
            </div>


            <div class="form-group">
                <?= $form->label('download_expiry_hours', t('Digital Download Expiry')); ?>
                <div class="input-group">
                    <?= $form->number('download_expiry_hours', Config::get('community_store.download_expiry_hours'), ['placeholder' => '48']); ?>
                    <div class="input-group-addon input-group-text"><?= t('hours'); ?></div>
                </div>
                <p class="help-block"><?= t('Number of hours before digital download links expiry'); ?></p>
            </div>
        </div>

        <!-- #settings-checkout -->
        <div class="col-sm-9 store-pane" id="settings-checkout">
            <h3><?= t('Cart and Checkout'); ?></h3>
            <div class="form-group">
                <?php $shoppingDisabled = Config::get('community_store.shoppingDisabled');
                ?>
                <div class="checkbox form-check">
                    <div class="radio"><label><?= $form->radio('shoppingDisabled', ' ', ('' == $shoppingDisabled)); ?><?php echo t('Enabled'); ?></label></div>
                    <div class="radio"><label><?= $form->radio('shoppingDisabled', 'all', 'all' == $shoppingDisabled); ?><?php echo t('Disabled (Catalog Mode)'); ?></label></div>
                </div>
            </div>

            <div class="form-group">
                <?= $form->label('orderNotesEnabled', t('Order notes')); ?>
                <br/>
                <label><?= $form->checkbox('orderNotesEnabled', '1', Config::get('community_store.orderNotesEnabled')); ?>
                    <?= t('Enable order notes field'); ?>
                </label>

            </div>

            <div class="form-group">
                <?= $form->label('guestCheckout', t('Cart Open Style')); ?>
                <?php $cartMode = Config::get('community_store.cartMode');
                ?>

                <div class="checkbox form-check">
                    <div class="radio"><label><?= $form->radio('cartMode', ' ', ('' == $cartMode)); ?><?php echo t('Modal'); ?></label></div>
                    <div class="radio"><label><?= $form->radio('cartMode', 'slide', 'slide' == $cartMode); ?><?php echo t('Slide'); ?></label></div>
                </div>
            </div>


            <div class="form-group ">
                <?= $form->label('guestCheckout', t('Guest Checkout')); ?>
                <?php $guestCheckout = Config::get('community_store.guestCheckout');
                $guestCheckout = ($guestCheckout ? $guestCheckout : 'off');
                ?>

                <div class="checkbox form-check">
                    <div class="radio"><label><?= $form->radio('guestCheckout', 'always', 'always' == $guestCheckout); ?><?php echo t('Always (unless login required for products in cart)'); ?></label></div>
                    <div class="radio"><label><?= $form->radio('guestCheckout', 'option', 'option' == $guestCheckout); ?><?php echo t('Offer as checkout option'); ?></label></div>
                    <div class="radio"><label><?= $form->radio('guestCheckout', 'off', 'off' == $guestCheckout || '' == $guestCheckout); ?><?php echo t('Disabled'); ?></label></div>
                </div>
            </div>

            <div class="form-group">
                <?= $form->label('useCaptcha', t('Use CAPTCHA')); ?>
                <br/>
                <label><?= $form->checkbox('useCaptcha', '1', Config::get('community_store.useCaptcha')); ?>
                    <?= t('Challenge Customers with CAPTCHA before checkout'); ?>
                </label>

            </div>


            <div class="form-group">
                <?= $form->label('orderCompleteCID', t('Order Complete Destination')); ?>
                <?php $orderCompleteCID = Config::get('community_store.orderCompleteCID'); ?>
                <?= $pageSelector->selectPage('orderCompleteCID', $orderCompleteCID); ?>
                <span class="help-block"><?= t('If left unselected, will redirect to default order completion page. May be overriden by product configuration.'); ?></span>
            </div>


            <div class="form-group">
                <?= $form->label('placesAPIKey', t('Address Auto-Complete API Key (Google Places)')); ?>
                <?= $form->text('placesAPIKey', Config::get('community_store.placesAPIKey')); ?>
            </div>


            <div class="form-group">
                <?= $form->label('checkoutScrollOffset', t('Checkout Scroll Offset')); ?>
                <div class="input-group">
                    <?= $form->number('checkoutScrollOffset', Config::get('community_store.checkout_scroll_offset')); ?>
                    <div class="input-group-addon input-group-text"><?= t('px'); ?></div>
                </div>
                <span class="help-block"><?= t('If your theme has a fixed header area in the checkout, enter a height in pixels of this area to offset the automatic scroll amount'); ?></span>
            </div>

            <div class="form-group">
                <?= $form->label('companyField', t('Company Name')); ?>
                <?php $companyField = Config::get('community_store.companyField');
                $companyField = ($companyField ? $companyField : 'off');
                ?>

                <div class="checkbox form-check">
                    <div class="radio"><label><?= $form->radio('companyField', 'off', 'off' == $companyField || '' == $companyField); ?><?php echo t('Hidden'); ?></label></div>
                    <div class="radio"><label><?= $form->radio('companyField', 'optional', 'optional' == $companyField); ?><?php echo t('Optional'); ?></label></div>
                    <div class="radio"><label><?= $form->radio('companyField', 'required', 'required' == $companyField); ?><?php echo t('Required'); ?></label></div>
                </div>
            </div>

            <h3><?= t('Billing Details'); ?></h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="checkbox form-check">
                    <label><?= $form->checkbox('noBillingSave', '1', Config::get('community_store.noBillingSave') ? '1' : '0'); ?>
                        <?= t('Do not save billing details to user on order'); ?></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="ccm-search-field-content">
                        <?= $form->label('noBillingSaveGroups', t('For users in groups')); ?>
                        <?= $form->selectMultiple('noBillingSaveGroups', $groupList, explode(',', Config::get('community_store.noBillingSaveGroups')), ['class' => 'selectize', 'style' => 'width: 100%', 'placeholder' => t('All Users/Groups')]); ?>
                    </div>
                </div>
            </div>


            <h3><?= t('Shipping Details'); ?></h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="checkbox form-check">
                    <label><?= $form->checkbox('noShippingSave', '1', Config::get('community_store.noShippingSave') ? '1' : '0'); ?>
                        <?= t('Do not save shipping details to user on order'); ?></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="ccm-search-field-content">
                        <?= $form->label('noShippingSaveGroups', t('For users in groups')); ?>
                        <?= $form->selectMultiple('noShippingSaveGroups', $groupList, explode(',', Config::get('community_store.noShippingSaveGroups')), ['class' => 'selectize', 'style' => 'width: 100%', 'placeholder' => t('All Users/Groups')]); ?>
                    </div>
                </div>
            </div>


            <script>
                $(document).ready(function () {
                    $('.selectize').selectize({
                        plugins: ['remove_button'],
                        selectOnTab: true
                    });
                    $('.selectize').removeClass('form-control');
                });
            </script>

        </div>

        <!-- #settings-orders -->
        <div class="col-sm-9 store-pane" id="settings-orders">
            <h3><?= t('Orders'); ?></h3>
            <div class="form-group">
                <label><?= $form->checkbox('showUnpaidExternalPaymentOrders', '1', Config::get('community_store.showUnpaidExternalPaymentOrders') ? '1' : '0'); ?>
                    <?= t('Unhide orders with incomplete payments (i.e. cancelled Paypal transactions)'); ?></label>
            </div>

            <div class="form-group">
                <?= $form->label('numberOfOrders', t('Number of orders displayed per page on orders dashboard page')); ?>
                <?= $form->select('numberOfOrders', [20 => 20, 50 => 50, 100 => 100, 500 => 500], Config::get('community_store.numberOfOrders'), ['style' => 'width: 125px;']) ?>
            </div>

            <div class="checkbox">
                <label>
                    <?= $form->checkbox('logUserAgent', '1', (bool)Config::get('community_store.logUserAgent')) ?>
                    <?= t('Log User Agent') ?>
                    <span class="small text-muted"><br/><?= t('Log the user agent against the order (this will effect your GDPR compliance).') ?></span>
                </label>
            </div>

        </div>

        <!-- #settings-user-interface -->
        <div class="col-sm-9 store-pane" id="settings-user-interface">
            <h3><?= t('User Interface'); ?></h3>

            <label class="form-label"><?= t('Product Options'); ?></label>
            <div class="form-group">
                <div class="checkbox form-check">
                    <label><?= $form->checkbox('hideStockAvailabilityDates', true, Config::get('community_store.hideStockAvailabilityDates')); ?>
                        <?= t('Hide stock availability dates'); ?>
                    </label>
                </div>

                <div class="checkbox form-check">
                    <label><?= $form->checkbox('hideSalePrice', true, Config::get('community_store.hideSalePrice')); ?>
                        <?= t('Hide sale price'); ?>
                    </label>
                </div>


                <div class="checkbox form-check">
                    <label><?= $form->checkbox('hideWholesalePrice', true, Config::get('community_store.hideWholesalePrice')); ?>
                        <?= t('Hide wholesale price'); ?>
                    </label>
                </div>

                <div class="checkbox form-check">
                    <label><?= $form->checkbox('hideCostPrice', true, Config::get('community_store.hideCostPrice')); ?>
                        <?= t('Hide cost price'); ?>
                    </label>
                </div>


                <div class="checkbox form-check">
                    <label><?= $form->checkbox('hideCustomerPriceEntry', true, Config::get('community_store.hideCustomerPriceEntry')); ?>
                        <?= t('Hide customer price entry option'); ?>
                    </label>
                </div>

                <div class="checkbox form-check">
                    <label><?= $form->checkbox('hideQuantityBasedPricing', true, Config::get('community_store.hideQuantityBasedPricing')); ?>
                        <?= t('Hide quantity based pricing option'); ?>
                    </label>
                </div>

                <div class="checkbox form-check">
                    <label><?= $form->checkbox('productDefaultActive', true, Config::get('community_store.productDefaultActive')); ?>
                        <?= t('Set product to active status by default'); ?>
                    </label>
                </div>

                <div class="checkbox form-check">
                    <label><?= $form->checkbox('productDefaultShippingNo', true, Config::get('community_store.productDefaultShippingNo')); ?>
                        <?= t('Set product shippable status to no by default'); ?>
                    </label>
                </div>
            </div>

            <label class="form-label"><?= t('Variation Options'); ?></label>
            <div class="checkbox form-check">
                <label><?= $form->checkbox('hideVariationPrices', true, Config::get('community_store.hideVariationPrices')); ?>
                    <?= t('Hide variation prices'); ?>
                </label>
            </div>

            <div class="checkbox form-check">
                <label><?= $form->checkbox('hideVariationShippingFields', true, Config::get('community_store.hideVariationShippingFields')); ?>
                    <?= t('Hide variation shipping fields'); ?>
                </label>
            </div>

            <div class="checkbox form-check">
                <label><?= $form->checkbox('variationDefaultUnlimited', true, Config::get('community_store.variationDefaultUnlimited')); ?>
                    <?= t('Set new variations to unlimited by default'); ?>
                </label>
            </div>

        </div>
    </div>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-primary float-end" type="submit"><?= t('Save'); ?></button>
        </div>
    </div>

</form>

<style>
    #ccm-dashboard-content-regular .nav-pills.nav-stacked .active a {
        font-weight: bold
    }
</style>
