import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["input", "toggle"];

    connect() {
        this.updateIcon();
    }

    toggle() {
        if (this.inputTarget.type === "password") {
            this.inputTarget.type = "text";
        } else {
            this.inputTarget.type = "password";
        }
        this.updateIcon();
    }

    updateIcon() {
        if (this.inputTarget.type === "password") {
            this.toggleTarget.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="M12 16q1.875 0 3.188-1.313T16.5 11.5q0-1.875-1.313-3.188T12 7q-1.875 0-3.188 1.313T7.5 11.5q0 1.875 1.313 3.188T12 16Zm0-1.8q-1.125 0-1.913-.788T9.3 11.5q0-1.125.788-1.913T12 8.8q1.125 0 1.913.788T14.7 11.5q0 1.125-.787 1.913T12 14.2Zm0 4.8q-3.65 0-6.65-2.038T1 11.5q1.35-3.425 4.35-5.463T12 4q3.65 0 6.65 2.038T23 11.5q-1.35 3.425-4.35 5.463T12 19Z"></path></svg>`;
        } else {
            this.toggleTarget.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="m16.1 13.3l-1.45-1.45q.225-1.175-.675-2.2t-2.325-.8L10.2 7.4q.425-.2.863-.3T12 7q1.875 0 3.188 1.313T16.5 11.5q0 .5-.1.938t-.3.862Zm3.2 3.15l-1.45-1.4q.95-.725 1.688-1.587T20.8 11.5q-1.25-2.525-3.588-4.013T12 6q-.725 0-1.425.1T9.2 6.4L7.65 4.85q1.025-.425 2.1-.638T12 4q3.775 0 6.725 2.087T23 11.5q-.575 1.475-1.513 2.738T19.3 16.45Zm.5 6.15l-4.2-4.15q-.875.275-1.762.413T12 19q-3.775 0-6.725-2.087T1 11.5q.525-1.325 1.325-2.463T4.15 7L1.4 4.2l1.4-1.4l18.4 18.4l-1.4 1.4ZM5.55 8.4q-.725.65-1.325 1.425T3.2 11.5q1.25 2.525 3.588 4.013T12 17q.5 0 .975-.063t.975-.137l-.9-.95q-.275.075-.525.113T12 16q-1.875 0-3.188-1.312T7.5 11.5q0-.275.038-.525t.112-.525L5.55 8.4Zm7.975 2.325ZM9.75 12.6Z"></path></svg>`;
        }
    }
}
