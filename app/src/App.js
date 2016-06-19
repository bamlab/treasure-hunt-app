import React, { Component } from 'react';
import {
  DeviceEventEmitter,
  StyleSheet,
  Text,
  View
} from 'react-native';
import Title from './components/Title';

import Logo from './components/Logo';
var Beacons = require('react-native-ibeacon');
import Tip from './components/Tip';

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
        <Logo/>
        <Title/>
        <Text style={styles.welcome}>
          {this.props.beaconData}
        <Tip number={1} message="Dans un jardin à côté du sénat"/>
        </Text>
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
    backgroundColor: 'white',
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
