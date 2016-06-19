import React, { Component } from 'react';
import {
  DeviceEventEmitter,
  ListView,
  StyleSheet,
  Text,
  View,
} from 'react-native';

import Title from './components/Title';
import ClosestBeacon from './components/ClosestBeacon';

class App extends Component {
  render() {

    return (
      <View style={styles.container}>
        <ClosestBeacon/>
        <Text style={styles.instructions}>
          Press Cmd+R to reload,{'\n'}
          Cmd+D or shake for dev menu
        </Text>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#F5FCFF',
  },
  welcome: {
    fontSize: 20,
    textAlign: 'center',
    margin: 10,
  },
  instructions: {
    textAlign: 'center',
    color: '#333333',
    marginBottom: 5,
  },
});

App.defaultProps = {
  beaconData: 'Not connected'
};

export default App;
