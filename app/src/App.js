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
        <Title/>
        <Text>
          {this.props.beaconData}
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
    backgroundColor: '#F5FCFF',
  }
});

App.defaultProps = {
  beaconData: 'Not connected'
};

export default App;
