import React, { Component } from 'react';
import {
  DeviceEventEmitter,
  StyleSheet,
  Text,
  View
} from 'react-native';
import Title from './components/Title';
import Logo from './components/Logo';
import ClosestBeacon from './components/ClosestBeacon';
import Tip from './components/Tip';
import RewardPopup from './components/RewardPopup'
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
        <Logo/>
        <Title title="TreasureHunt !"/>
        <Text>
          {this.props.beaconData}
        </Text>
        <Tip number={1} message="Dans un jardin à côté du sénat"/>
        <ClosestBeacon/>
        <RewardPopup/>
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
  }
});

App.defaultProps = {
  beaconData: 'Not connected'
};

export default App;
