
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {

    window.$ = window.jQuery = require('jquery');
    require('bootstrap-sass');
    require('datatables.net-bs')();
    
} catch (e) { }

require('bootstrap-select');
// require('jquery-ui');
require('jquery-ui-dist/jquery-ui');
// require('jquery-form');
