import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';

it('Welcome without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<Welcome />, div);
});
