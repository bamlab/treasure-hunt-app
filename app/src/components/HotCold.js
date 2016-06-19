import React, { Component } from 'react';
import {
  Text,
  Image
} from 'react-native';

class HotCold extends Component {
  static propTypes = {
    distance: React.PropTypes.number.isRequired
  };
  render() {
    return (
      <Image
        source={require('../img/cold.png')}
      />
    );
  }
}

export default HotCold;
