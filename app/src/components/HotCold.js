import React, { Component } from 'react';
import {
  Text,
  Image
} from 'react-native';

class HotCold extends Component {
  render() {
    let proximity = this.props.accuracy.toFixed(2);
    if (proximity > 5) {
      return (
        <Image source={require('../img/cold-ice.png')} />
      );
    }
    else if (5 > proximity > 4) {
      return (
        <Image source={require('../img/cold-navy.png')} />
      );
    }
    else if (4 > proximity > 3) {
      return (
        <Image source={require('../img/cold-vert-fonce.png')} />
      );
    }
    else if (3 > proximity > 2) {
      return (
        <Image source={require('../img/hot-jaune.png')} />
      );
    }
    else if (2 > proximity > 1) {
      return (
        <Image source={require('../img/hot-orange.png')} />
      );
    }
    else if (1 > proximity) {
      return (
        <Image source={require('../img/hot.png')} />
      );
    }
  }
}

export default HotCold;
