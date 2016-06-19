import React, { Component } from 'react';
import {
  StyleSheet,
  Text
} from 'react-native';

class Title extends Component {
  render() {
    return (
      <Text style={styles.title}>
        Titre
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
