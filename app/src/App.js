import React, { Component } from 'react';
import {
  DeviceEventEmitter,
  StyleSheet,
  Text,
  View
} from 'react-native';
import Title from './components/Title';

var Beacons = require('react-native-ibeacon');

class App extends Component {
  componentWillMount() {
    var region = {
        identifier: 'Estimotes',
        uuid: 'B9407F30-F5F8-466E-AFF9-25556B57FE6D'
    };

    var subscription = DeviceEventEmitter.addListener(
      'beaconsDidRange',
      (data) => {
        this.props.beaconData = data;
      }
    );

    // Request for authorization while the app is open
    Beacons.requestWhenInUseAuthorization();

    Beacons.startMonitoringForRegion(region);
    Beacons.startRangingBeaconsInRegion(region);

    Beacons.startUpdatingLocation();
  };

  render() {

    return (
      <View style={styles.container}>
        <Text style={styles.welcome}>
          {this.props.beaconData}
        </Text>
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
