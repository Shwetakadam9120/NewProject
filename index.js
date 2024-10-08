import React from 'react';
import ReactDOM from 'react-dom';
import '.backend.css'; // Ensure this path is correct and the file exists

import App from './App';

ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById('root')
);
