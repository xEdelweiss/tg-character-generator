Feature: character generation

  Scenario: Basic generation
    Given I have test rules
    And I have test setting
    When I generate character
    Then Character's "height" should be between 150 and 200