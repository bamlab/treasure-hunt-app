import React, { Component } from 'react';
import {
  Image
} from 'react-native';

class Logo extends Component {
  render() {
    return (
      <Image
        style={style}
        source={require('../img/treasure.png')}
      />
    );
  }
}

const style = {
  height: 200,
  resizeMode: 'contain'
}

export default Logo;
