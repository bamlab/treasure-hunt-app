import React, { Component } from 'react';
import {
  Text
} from 'react-native';

class Tip extends Component {
  static defaultProps = {
    number: 1,
    message: "Test"
  };
  render() {
    return (
      <Text>
        Indice numéro {this.props.number} : {this.props.message}
      </Text>
    );
  }
}

export default Tip;
