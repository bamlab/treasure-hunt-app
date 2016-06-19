import React, { Component } from 'react';
import {
  DeviceEventEmitter,
  StyleSheet,
  Text,
  View,
} from 'react-native';

var _ = require('lodash')

var Beacons = require('react-native-ibeacon');

var region = {
    identifier: 'BAM',
    uuid: 'B9407F30-F5F8-466E-AFF9-25556B57FE6D'
};

Beacons.requestWhenInUseAuthorization();
Beacons.startRangingBeaconsInRegion(region);
Beacons.startUpdatingLocation();

class BeaconView extends Component {
  render() {
   return (
     <View style={styles.row}>
       <Text style={styles.smallText}>UUID: {this.props.uuid}</Text>
       <Text style={styles.smallText}>Major: {this.props.major}</Text>
       <Text style={styles.smallText}>Minor: {this.props.minor}</Text>
       <Text>RSSI: {this.props.rssi}</Text>
       <Text>Proximity: {this.props.proximity}</Text>
       <Text>Distance: {this.props.accuracy.toFixed(2)}m</Text>
     </View>
   );
  }
}

class ClosestBeacon extends Component {
  constructor(props) {
    super(props);

    this.state = {
      beacon: {}
    };
  };

  componentWillMount() {
    // Listen for beacon changes
    var subscription = DeviceEventEmitter.addListener(
      'beaconsDidRange',
      (data) => {
        var beacon;

        console.log(data.beacons);

        if (data && data.beacons.length) {
          if (_.isEmpty(this.state.beacon)) {
            // initialize to a random beacon
            // @todo : choose the closest one
            this.setState({
              beacon: data.beacons[0]
            });

            return;
          }

          for (var i = 0, len = data.beacons.length; i < len; i++) {
            beacon = data.beacons[i];

            if (beacon.accuracy < 0) {
              // error reading accuracy so skip the beacon
              continue;
            }

            if (beacon.uuid + beacon.major + beacon.minor == this.state.beacon.uuid + this.state.beacon.major + this.state.beacon.minor) {
              this.setState({
                beacon: beacon
              });
            } else if (beacon.accuracy < this.state.beacon.accuracy) {
              this.setState({
                beacon: beacon
              });
            }
          }
        }
      }
    );
  };

 render() {
   if (_.isEmpty(this.state.beacon)) {
     return (
       <View style={styles.container}>
         <Text>Searching...</Text>
       </View>
     )
   }

   return (
     <View style={styles.container}>
      <BeaconView {...this.state.beacon} style={styles.row} />
     </View>
   );
 };
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


export default ClosestBeacon
