@auth @auth_emailadmin
Feature: User must accept policy when logging in using auth_emailadmin
  In order to record user agreement to use the site
  As a user
  I need to be able to accept site policy during sign up

  Scenario: Accept policy on sign up with emailadmin, no site policy
    Given the following config values are set as admin:
      | registerauth    | emailadmin |
      | passwordpolicy  | 0          |
    And I am on site homepage
    And I follow "Log in"
    When I press "Create new account"
    Then I should not see "I understand and agree"
    And I set the following fields to these values:
      | Username      | user1                 |
      | Password      | user1                 |
      | Email address | user1@address.invalid |
      | Email (again) | user1@address.invalid |
      | First name    | User1                 |
      | Surname       | L1                    |
    # And I click on "Create new account" "link"
    And I press "Create my new account"
    And I should see "Confirm your account"
    And I should see "Your account has been registered and is pending confirmation by the administrator."
    And I press "Continue"
    And I should see "You are not logged in"
    And I confirm email for "user1"
    And I should see "Thanks, User1 L1"
    And I should see "Your registration has been confirmed"
    And I open my profile in edit mode
    And the field "First name" matches value "User1"
    And I log out
    When I log in as "admin"
    And I navigate to "Users > Accounts > Browse list of users" in site administration
    And I follow "User1 L1"
    And I follow "Edit profile"
    Then I should see "User1"

  Scenario: Accept policy on sign up with auth emailadmin
    Given the following config values are set as admin:
      | registerauth    | emailadmin         |
      | passwordpolicy  | 0                  |
      | sitepolicy      | https://moodle.org |
    And I am on site homepage
    And I follow "Log in"
    When I press "Create new account"
    Then the field "I understand and agree" matches value "0"
    And I set the following fields to these values:
      | Username      | user1                 |
      | Password      | user1                 |
      | Email address | user1@address.invalid |
      | Email (again) | user1@address.invalid |
      | First name    | User1                 |
      | Surname       | L1                    |
      | I understand and agree | 1            |
    And I press "Create my new account"
    And I should see "Confirm your account"
    And I should see "Your account has been registered and is pending confirmation by the administrator."
    And I press "Continue"
    And I should see "You are not logged in"
    And I confirm email for "user1"
    And I should see "Thanks, User1 L1"
    And I should see "Your registration has been confirmed"
    And I open my profile in edit mode
    And the field "First name" matches value "User1"
    And I log out
    When I log in as "admin"
    And I navigate to "Users > Accounts > Browse list of users" in site administration
    And I follow "User1 L1"
    And I follow "Edit profile"
    Then I should see "User1"
    And I log out
    # Confirm that user is not asked to agree to site policy again after the next login.
    # And I log in as "user1"
    # And I open my profile in edit mode
    # And the field "First name" matches value "User1"
