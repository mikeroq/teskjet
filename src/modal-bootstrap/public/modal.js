/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/modal.js ***!
  \*******************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.LivewireUiModal = function () {
  return {
    show: false,
    showActiveComponent: true,
    activeComponent: false,
    componentHistory: [],
    modalWidth: 'sm:max-w-2xl',
    modalTitle: '',
    getActiveComponentModalAttribute: function getActiveComponentModalAttribute(key) {
      if (this.$wire.get('components')[this.activeComponent] !== undefined) {
        return this.$wire.get('components')[this.activeComponent]['modalAttributes'][key];
      }
    },
    closeModalOnEscape: function closeModalOnEscape(trigger) {
      if (this.getActiveComponentModalAttribute('closeOnEscape') === false) {
        return;
      }

      var force = this.getActiveComponentModalAttribute('closeOnEscapeIsForceful') === true;
      this.closeModal(force);
    },
    closeModalOnClickAway: function closeModalOnClickAway(trigger) {
      if (this.getActiveComponentModalAttribute('closeOnClickAway') === false) {
        return;
      }

      this.closeModal(true);
    },
    closeModal: function closeModal() {
      var force = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var skipPreviousModals = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

      if (this.getActiveComponentModalAttribute('dispatchCloseEvent') === true) {
        var componentName = this.$wire.get('components')[this.activeComponent].name;
        Livewire.emit('modalClosed', componentName);
      }

      if (skipPreviousModals > 0) {
        for (var i = 0; i < skipPreviousModals; i++) {
          this.componentHistory.pop();
        }
      }

      var id = this.componentHistory.pop();

      if (id && force === false) {
        this.setActiveModalComponent(id, true);
      }

      if (this.isBootstrap()) {
        this.bsCloseModal(this.activeComponent);
        return;
      }

      this.show = false;
    },
    setActiveModalComponent: function setActiveModalComponent(id) {
      var _this = this;

      var skip = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      this.show = true;

      if (this.activeComponent !== false && skip === false) {
        this.componentHistory.push(this.activeComponent);
      }

      var focusableTimeout = 50;

      if (this.activeComponent === false) {
        this.componentAttributes(id);
      } else {
        this.showActiveComponent = false;
        focusableTimeout = 400;
        setTimeout(function () {
          _this.componentAttributes(id);
        }, 300);
      }

      this.$nextTick(function () {
        var focusable = _this.$refs[id].querySelector('[autofocus]');

        if (focusable) {
          setTimeout(function () {
            focusable.focus();
          }, focusableTimeout);
        }
      });

      if (this.isBootstrap()) {
        this.modalTitle = this.getActiveComponentModalAttribute('bsTitle');
        this.bsOpenModal(id);
      }
    },
    focusables: function focusables() {
      var selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])';
      return _toConsumableArray(this.$el.querySelectorAll(selector)).filter(function (el) {
        return !el.hasAttribute('disabled');
      });
    },
    firstFocusable: function firstFocusable() {
      return this.focusables()[0];
    },
    lastFocusable: function lastFocusable() {
      return this.focusables().slice(-1)[0];
    },
    nextFocusable: function nextFocusable() {
      return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable();
    },
    prevFocusable: function prevFocusable() {
      return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable();
    },
    nextFocusableIndex: function nextFocusableIndex() {
      return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1);
    },
    prevFocusableIndex: function prevFocusableIndex() {
      return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1;
    },
    init: function init() {
      var _this2 = this;

      this.$watch('show', function (value) {
        if (value) {
          document.body.classList.add('overflow-y-hidden');
        } else {
          document.body.classList.remove('overflow-y-hidden');
          setTimeout(function () {
            _this2.activeComponent = false;

            _this2.$wire.resetState();
          }, 300);
        }
      });
      Livewire.on('closeModal', function () {
        var force = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
        var skipPreviousModals = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

        _this2.closeModal(force, skipPreviousModals);
      });
      Livewire.on('activeModalComponentChanged', function (id) {
        _this2.setActiveModalComponent(id);
      });
    },
    componentAttributes: function componentAttributes(id) {
      this.activeComponent = id;
      this.showActiveComponent = true;
      this.modalWidth = 'sm:max-w-' + this.getActiveComponentModalAttribute('maxWidth');

      if (this.isBootstrap()) {
        this.modalWidth = this.bsModalWidth();
      }
    },
    isBootstrap: function isBootstrap() {
      return this.getActiveComponentModalAttribute('framework') === 'bootstrap';
    },
    bsModalWidth: function bsModalWidth() {
      var width = this.getActiveComponentModalAttribute('bsWidth');

      if (width !== '') {
        return 'modal-' + width;
      }
    },
    bsModal: function bsModal(modal) {
      return document.getElementById(modal);
    },
    bsCloseModal: function bsCloseModal(modal) {
      var _this3 = this;


      this.bsModal(modal).setAttribute('aria-hidden', 'true');
      document.body.classList.remove('modal-open');

      setTimeout(function () {
        _this3.bsModal(modal).classList.remove('show');
      });
      setTimeout(function () {
        _this3.bsModal(modal).style.display = 'none';
    
      }, 500);
    },
    bsOpenModal: function bsOpenModal(modal) {
      var _this4 = this;


      document.body.classList.add('modal-open');
      this.bsModal(modal).style.display = 'block';
      this.bsModal(modal).setAttribute('aria-hidden', 'false', 'show');
      setTimeout(function () {
        _this4.bsModal(modal).classList.add('show');
      });
    }
  };
};
/******/ })()
;