import React, { Component } from 'react';
import {
  StyleSheet,
  Text
} from 'react-native';

class Title extends Component {
  static propTypes = {
    title: React.PropTypes.string.isRequired
  };

  render() {
    return (
      <Text style={styles.title}>
        {this.props.title}
      </Text>
    );
  }
}

const styles = StyleSheet.create({
  title: {
    fontSize: 19,
    fontWeight: 'bold'
  }
});

export default Title;
