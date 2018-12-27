/*
    Shopify Tour
    2.0.0
 */

'use strict';

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

(function ($) {
  var Tour = (function () {
    function Tour() {
      _classCallCheck(this, Tour);

      this.$body = $(document.body);

      this.tourStrings = ZillaCommerceTour['tourStrings'];
      this.tourSteps = ZillaCommerceTour['tourSteps'];
      this.stepsList = [];
      this.showLanding = false;

      if (typeof ZillaCommerceTour['step'] != 'undefined') {
        this.stepCount = ZillaCommerceTour['step'];
      } else {
        this.stepCount = 0;
        this.showLanding = true;
      }

      for (var label in this.tourSteps) {
        this.stepsList.push(label);
      }

      this.$body.addClass('zilla-shopify-tour');

      if (this.showLanding) {
        this._createLanding();
        this.$body.addClass('tour-start');
      } else {
        this._takeStep();
      }
    }

    _createClass(Tour, [{
      key: '_createLanding',
      value: function _createLanding() {
        var _this = this;

        var $landingStructure = '\n        <div class="zilla-shopify-tour-background">\n          <div class="zilla-shopify-tour-modal">\n            <div class="landing-intro">\n              <img class="emblem" src="' + this.tourStrings.templateDirectory + '/zillacommerce/images/themezilla.png" />\n              <h1>' + this.tourStrings.landingTitle + '</h1>\n              <p class="lead">' + this.tourStrings.landingAbout + '</p>\n            </div>\n            <div class="landing-actions">\n              <button class="decline">' + this.tourStrings.buttonDecline + '</button>\n              <button class="start">' + this.tourStrings.buttonStart + '</button>\n            </div>\n          </div>\n        </div>\n      ';

        this.$body.append($landingStructure);

        $('.zilla-shopify-tour-background').find('.start').click(function (event) {
          _this._startTour();
        });

        $('.zilla-shopify-tour-background').find('.decline').click(function (event) {
          _this._exitTour();
        });
      }
    }, {
      key: '_startTour',
      value: function _startTour() {
        this.$body.removeClass('tour-start');
        this._takeStep();
      }
    }, {
      key: '_exitTour',
      value: function _exitTour() {
        this.$body.removeClass('zilla-shopify-tour tour-start');
      }
    }, {
      key: '_takeStep',
      value: function _takeStep() {
        var _this2 = this;

        if (this.stepCount != this.stepsList.length) {
          (function () {
            var label = _this2.stepsList[_this2.stepCount];
            var step = _this2.tourSteps[label];

            var $input = '';
            var $element = '';
            var $tourStep = '';
            var attachment = 'middle left';
            var targetAttachment = 'middle right';

            // Determine which buttons to display in the bubble
            if (_this2.stepCount < _this2.stepsList.length - 1) {
              $tourStep = '\n            <div class="zilla-shopify-tour-step">\n              <h3>' + label + '</h3>\n                ' + step[0] + '\n                <div class="nav-buttons">\n                  <button class="next-step full">\n                    ' + _this2.tourStrings.buttonNext + '\n                  </button>\n                </div>\n            </div>\n          ';
              _this2.$body.append($tourStep);
              $('.next-step').click(function (event) {
                _this2._stepFunctions(step[1], step[2]);
              });
            } else {
              $tourStep = '\n            <div class="zilla-shopify-tour-step">\n              <h3>' + label + '</h3>\n                ' + step[0] + '\n                <div class="nav-buttons">\n                  <button class="finish full">\n                    ' + _this2.tourStrings.buttonFinish + '\n                  </button>\n                </div>\n            </div>\n          ';
              _this2.$body.append($tourStep);
              $('.finish').click(function (event) {
                _this2._stepFunctions(step[1], step[2]);
              });
            }

            setTimeout(function () {
              $element = $('.zilla-shopify-tour-step');

              switch (parseInt(_this2.stepCount)) {
                case 0:
                  $input = $('#menu-pages');
                  var href1 = $('#menu-pages .menu-top').attr('href');
                  $('.menu-icon-page').attr('href', href1 + '&tour&step=1');
                  break;

                case 1:
                  $input = $('.page-title-action');
                  attachment = 'top left';
                  targetAttachment = 'top right';
                  var href2 = $('.page-title-action').attr('href');
                  $('.page-title-action').attr('href', href2 + '&tour&step=2');
                  break;

                case 2:
                  $input = $('#zillacommerce-add-product');
                  $('#zillacommerce-add-product').click(function (event) {
                    $('.zilla-shopify-tour-step').hide();
                    _this2._exitTour();
                  });
                  break;
              }

              new Tether({
                element: $element,
                target: $input,
                attachment: attachment,
                targetAttachment: targetAttachment,
                offset: '0 -15px',
                constraints: [{
                  to: 'window',
                  pin: true
                }]
              });

              $element.addClass('visible');
              _this2.stepCount = _this2.stepCount + 1;
            }, 500);
          })();
        }
      }
    }, {
      key: '_stepFunctions',
      value: function _stepFunctions(link, action) {
        switch (action) {
          case 'link':
            window.location = link;
            break;

          case 'addProduct':
            this._finishTour();
            $(link).click();
            break;
        }
      }
    }, {
      key: '_finishTour',
      value: function _finishTour() {
        this.$body.removeClass('zilla-shopify-tour');
        $('.zilla-shopify-tour-step').remove();
      }
    }]);

    return Tour;
  })();

  var tour = new Tour();
})(jQuery);