@managing_channels
Feature: Selecting available currencies for a channel
    In order to give possibility to pay in different currencies on my stores website
    As an Administrator
    I want to be able to select available currencies

    Background:
        Given the store has currency Euro
        And I am logged in as an administrator

    @ui
    Scenario: Adding a new channel with currencies
        Given I want to create a new channel
        When I specify its code as MOBILE
        And I name it "Mobile store"
        And I allow to paying Euro for this channel
        And I add it
        Then I should be notified that it has been successfully created
        And paying in Euro should be possible for the "Mobile store" channel

    @ui
    Scenario: Adding currencies to an existing channel
        Given the store operates on a channel named "Web store"
        And I want to modify this channel
        And I allow to paying Euro for this channel
        And I save my changes
        Then I should be notified that it has been successfully edited
        And paying in Euro should be possible for the "Web store" channel
