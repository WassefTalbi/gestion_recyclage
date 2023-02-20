const notifyMe = () => {
    if (!window.Notification) {
      console.log('Browser does not support notifications.')
    } else {
      // check if permission is already granted
      if (Notification.permission === 'granted') {
        // show notification here
        const notify = new Notification('Hi there!', {
          body: 'How are you doing?',
          icon: 'https://bit.ly/2DYqRrh'
        })
      } else {
        // request permission from the user
        Notification.requestPermission()
          .then(function (p) {
            if (p === 'granted') {
              // show notification here
              const notify = new Notification('Hi there!', {
                body: 'How are you doing?',
                icon: 'https://bit.ly/2DYqRrh'
              })
            } else {
              console.log('User has blocked notifications.')
            }
          })
          .catch(function (err) {
            console.error(err)
          })
      }
    }
  }