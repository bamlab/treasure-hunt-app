import React, { Component } from 'react';
import {
  StyleSheet,
  Text,
  View
} from 'react-native';
import Title from './components/Title';

class App extends Component {
  render() {
    return (
      <View style={styles.container}>
        <Title/>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'flex-start',
    marginTop: 70,
    alignItems: 'center',
    backgroundColor: '#F5FCFF',
  }
});

export default App;
