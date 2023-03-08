define([
    'jquery',
    'mage/translate',
    'Magento_Ui/js/modal/alert',
], function ($, $t, alert) {
    'use strict';

    $.widget('wms.sync', {
        /**
         * Default options
         */
        options: {
            ajaxPostUrl: null,
            productSku: null,
            isSyncingAllowed: false,
            selectors: {
                wmsSyncButtonId: null,
                quantityInputName: null
            }
        },

        /**
         * Creates and initializes widget
         * @private
         */
        _create: function() {
            if (this.options.isSyncingAllowed) {
                this._bind();
            } else {
                this._removeSyncButton();
            }
        },

        /**
         * @private
         */
        _bind: function () {
            const self = this;
            $(self.options.selectors.wmsSyncButtonId).on("click", function (event) {
                event.preventDefault();
                self._ajaxPostRequest();
            })
        },

        /**
         *
         * @private
         */
        _removeSyncButton: function() {
            $(this.options.selectors.wmsSyncButtonId).remove();
        },

        /**
         * @private
         */
        _ajaxPostRequest: function () {
            const self = this;
            $.ajax({
                url: self.options.ajaxPostUrl,
                method: 'post',
                data: { "sku": self.options.productSku }
            }).success(function(response) {
                if (response.result.result === 'success') {
                    self._updateQuantityInputValue(response.result.quantity);
                    self._alert(
                        $t("Successful WMS Sync Request"),
                        $t("Product with sku %1 quantity has been updated to %2. </br>Click 'Save' button to apply changes.".replace('%1', response.result.sku).replace('%2', response.result.quantity)),
                        () => {}
                    );
                }
                if (response.result.result === 'error') {
                    self._alert(
                        $t("WMS Sync Request Error"),
                        $t("The following error occurred: </br> %1".replace('%1', response.result.error)),
                        () => {}
                    );
                }
                // keeping this console log for debugging purposes
                console.log(response.result);
            })
        },

        /**
         * Updates quantity input with new qty
         *
         * @param value
         * @private
         */
        _updateQuantityInputValue: function(value) {
            const self = this;
            let $input = $(self.options.selectors.quantityInputName);
            $input.val(value);
        },

        /**
         *
         * @param title
         * @param content
         * @param alwaysFunction
         * @private
         */
        _alert: function (title, content, alwaysFunction) {
            alert({
                title: title,
                content: content,
                actions: {
                    always: alwaysFunction
                }
            });
        },
    });

    return $.wms.sync;
})
