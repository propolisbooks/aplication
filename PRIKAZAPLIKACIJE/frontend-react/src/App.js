import React, { Component } from 'react';
import Routes from './routes.js';
import './App.css';

import Header from './components/Header/Header';
import Footer from './components/Footer/Footer';
import Welcome from './components/Welcome/Welcome';

class App extends Component {

    constructor(props){
      super(props);
      this.state={
        appName:"Cloudhorizont"
      }
    }
  render() {
    return (
      <div className="wrapper">
        <Header title ={this.state.appName}/>

           <div className="container-fluid">
             <Routes />
          </div>
         
        <Footer />
      </div>
    );
  }
}

export default App;
