define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('wms.sync', {
        /**
         * Default options
         */
        options: {
            ajaxPostUrl: null,
            productSku: null,
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
            this._bind();
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
                }
                if (response.result.result === 'error') {

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
        }
    });

    return $.wms.sync;
})
