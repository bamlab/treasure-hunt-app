import React, { Component } from 'react';
import {
  View,
  Text,
  Alert,
  TouchableHighlight,
  StyleSheet
} from 'react-native';

class RewardPopup extends Component {
  render() {
    return (
      <TouchableHighlight style={styles.wrapper}
          onPress={() => Alert.alert(
            'Super',
            'Tu as trouvé le Beacon !',
          )}>
        <View style={styles.button}>
          <Text>Trouvé</Text>
        </View>
      </TouchableHighlight>
    );
  }
}

const styles = StyleSheet.create({
  wrapper: {
    borderRadius: 5,
    marginBottom: 5,
  },
  button: {
    backgroundColor: '#eeeeee',
    padding: 10,
  },
});

export default RewardPopup;
