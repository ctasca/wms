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
                console.log(response.result)
            })
        }
    });

    return $.wms.sync;
})
