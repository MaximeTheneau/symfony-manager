import { startStimulusApp } from '@symfony/stimulus-bundle';
import password_controller from './controllers/password_controller.js';

const app = startStimulusApp();
// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

app.register('password', password_controller)