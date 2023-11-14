import { createApp } from 'vue';
import Notification from '@/components/notification/NotificationComponent.vue';

function createNotification({ message, type }) {
    const mountPoint = document.createElement('div');
    document.body.appendChild(mountPoint);
  
    const app = createApp(Notification, {
      message: message,
      notificationType: type,
      onClose: () => {
        app.unmount(mountPoint);
        document.body.removeChild(mountPoint);
      }
    });
  
    app.mount(mountPoint);
  }
  
  export function showSuccessMessage(message) {
    return createNotification({ message, type: 'success' });
  }
  
  export function showErrorMessage(message) {
    return createNotification({ message, type: 'error' });
  }