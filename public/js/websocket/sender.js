/**
 * Handles initiating a cast from the sender application.
 */
class Sender {

    constructor() {
        this.applicationID = 'Margin$';
        this.namespace = "urn:x-cast:com.github.lteran9.bahamut";
        this.session = null;
        this.context = null;
    }
    
    /**
     * @param ticker instructs the receiver application to change the ticker that is subscribed to.
     */
    onFeedChanged(ticker) {
        if (this.session) {
            this.session.sendMessage(this.namespace, { "ticker": ticker });
        }
    }

    /**
     * Starts the receiver application - creating a new session if one is not already available.
     * @param ticker the ticker that the receiver application will subscribe to when started.
     */
    cast(ticker) {
        this.session = this.session = this.context.getCurrentSession();

        if (this.session == null) {
            this.context.requestSession()
                .then(() => {
                    this.session = this.context.getCurrentSession();
                    this.session.addMessageListener(this.namespace, (event) => {
                        console.log(event);
                    });
                }).catch(e => {
                    console.log(e);
                });
        } else {
            this.onFeedChanged(ticker);
        }
    }
}