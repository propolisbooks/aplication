import React, { Component } from 'react';
import './Header.css';

class Header extends Component {
  render() {
    return (
      <div className="jumbotron">
  <div className="container text-center">
    <h1>{this.props.title}</h1>      
    <p>Pregled odmora.</p>
  </div>
</div>
    );
  }
}

export default Header;
