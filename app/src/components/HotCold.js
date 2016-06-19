import React, { Component } from 'react';
import {
  Text,
  Image
} from 'react-native';
import { HueRotate } from "gl-react-hue-rotate";
import { Surface } from "gl-react-native";

class HotCold extends Component {
  static propTypes = {
    distance: React.PropTypes.number.isRequired
  };
  render() {
    const cold = (
      <Surface width={200} height={200}>
        <HueRotate hue={1}>
          <Image source={require('../img/cold.png')}/>
        </HueRotate>
      </Surface>
    );

    const hot = (
      <Surface width={200} height={200}>
        <HueRotate hue={1}>
          <Image source={require('../img/hot.png')}/>
        </HueRotate>
      </Surface>
    );

    return this.props.distance > 10 ? cold : hot;
  }
}

export default HotCold;
