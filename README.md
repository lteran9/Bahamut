# Bahamut 
This project aims to be a crypto-trading state machine that can take actions when certain market conditions are met. The system is powered by the Coinbase API and requires an account with them (for the time being). 

## Installation
Before you can install the project you must have PHP 8.0 and MySQL installed on your machine (or Docker). There are plenty of resources online that can help you with the installation the OS of your choice. 

### Requirements
Bahamut is built on top of the Laravel framework. There are certain features to the framework that faciliate the communication between the Server and WebSocket. A slight understanding of how to run a Laravel application may be required to get things up and running on your computer. Additionally, a Coinbase account is required to retrieve market prices and place buy/sell orders. 

If you would like to contribute code/features to the project please create your own fork of the repository. This will help with branching and maintaining a stable codebase. We attempt to keep up with the PSR-1, PSR-4 and PSR-12 standards so please keep that in mind when creating Pull Requests. 

Lastly, the crypto space is full of predatory behavior. Make sure that you keep any and all sensitive information on your local copy of the .env file and never share the keys with anyone. Never commit this file to source control (it is currently ignored by default in the .gitignore file of this repository). 

### Clone Project

- Composer
- NPM 
- 

#### Run on Local Machine
- MySQL Database

#### Run on Docker
- MySQL Database

### CoinbaseAPI

#### Public / Secret Keys

## State Machine

### States

#### Buying
- Bullish (Heavy buy trend)
- Bearish (Slight buy trend)

#### Selling
- Bullish (Heavy sell trend)
- Bearish (Slight sell trend)

### Conditions
Conditions in this context are a set of parameters that must be met to advance to another state. Conditions can be chained together to create complex requirements. Some example conditions are listed below.

#### Target Price Reached
Returns true when the price of a specific coin is at or over the threshold. 

#### Target Price Lost
Returns true when the price of a specific coins is below the threshold. 

#### Market Volume Dip
Returns true when the 24 hour volume of a coin drops a specific percentage. 

#### Candlestick Pattern Found
Candlestick charts are a Japanese strategy of measuring emotions of traders in a market. Candlesticks show that emotion by visually representing the size/fluctuation of price moves. This type of chart is used to predict price movement based on past patterns. This last bit is important because it is important to remember predicting the future is (quantifiably) impossible. 

That said, Bahamut aims to provide a framework for scientists and crypto-enthusiasts to employ trading strategies which are measured automatically by the system to provide you with a performance result. 

- Bearish Engulfing Pattern
- Bullish Engulfing Pattern
- Bearish Evening Star
- Bearish Harami
- Bullish Harami
- Bearish Harami Cross
- Bullish Harami Cross
- Bullish Rising Three
- Bearish Falling Three

### Actions

### Transitions

## Limitations
At the moment this application is limited by the 
