"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;

/**
 * Clears the refinements of a SearchParameters object based on rules provided.
 * The included attributes list is applied before the excluded attributes list. If the list
 * is not provided, this list of all the currently refined attributes is used as included attributes.
 * @param {object} $0 parameters
 * @param {Helper} $0.helper instance of the Helper
 * @param {string[]} [$0.attributesToClear = []] list of parameters to clear
 * @returns {SearchParameters} search parameters with refinements cleared
 */
function clearRefinements(_ref) {
  var helper = _ref.helper,
      _ref$attributesToClea = _ref.attributesToClear,
      attributesToClear = _ref$attributesToClea === void 0 ? [] : _ref$attributesToClea;
  var finalState = helper.state.setPage(0);
  attributesToClear.forEach(function (attribute) {
    if (attribute === '_tags') {
      finalState = finalState.clearTags();
    } else {
      finalState = finalState.clearRefinements(attribute);
    }
  });

  if (attributesToClear.indexOf('query') !== -1) {
    finalState = finalState.setQuery('');
  }

  return finalState;
}

var _default = clearRefinements;
exports.default = _default;