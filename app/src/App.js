import React, { Component } from 'react';
import {
  DeviceEventEmitter,
  ListView,
  StyleSheet,
  Text,
  View,
} from 'react-native';
import Title from './components/Title';

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

var ds = new ListView.DataSource({rowHasChanged: (r1, r2) => r1 !== r2});

class BeaconList extends Component {
  constructor(props) {
    super(props);

    this.state = {
      dataSource: ds.cloneWithRows([])
    };
  };

  componentWillMount() {
    // Listen for beacon changes
    var subscription = DeviceEventEmitter.addListener(
      'beaconsDidRange',
      (data) => {
        if (data) {
          this.setState({
            dataSource: ds.cloneWithRows(data.beacons)
          });
        }
      }
    );
  };

  renderRow(rowData) {
    return <BeaconView {...rowData} style={styles.row} />
  };

 render() {
   return (
     <View style={styles.container}>
       <Text style={styles.headline}>All beacons in the area</Text>
       <ListView
         dataSource={this.state.dataSource}
         renderRow={this.renderRow}
       />
     </View>
   );
 };


}

class App extends Component {
  componentWillMount() {
    var subscription = DeviceEventEmitter.addListener(
      'beaconsDidRange',
      (data) => {
        this.props.beaconData = data;
      }
    );
  };

  render() {

    return (
      <View style={styles.container}>
        <Text style={styles.welcome}>
          {this.props.beaconData}
        </Text>
        <BeaconList/>
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
