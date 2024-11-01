import "core-js/stable";
import "regenerator-runtime/runtime";

import React from 'react';
import ReactDOM from 'react-dom';
import Settings from './admin/admin-index';

const settingsContainer = document.getElementById('ticket-spot-settings');
if (settingsContainer) {
  ReactDOM.render(<Settings />, settingsContainer);
}