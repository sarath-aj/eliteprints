// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })

// Import Cypress Percy plugin command (https://docs.percy.io/docs/cypress)
import "@percy/cypress";

// custom command to make taking snapshots with full name
// formed from the test title + suffix easier
// cy.visualSnapshot() // default full test title
// cy.visualSnapshot('clicked') // full test title + ' - clicked'
// also sets the width and height to the current viewport
Cypress.Commands.add("visualSnapshot", (maybeName) => {
  // @ts-ignore
  let snapshotTitle = cy.state("runnable").fullTitle();
  if (maybeName) {
    snapshotTitle = snapshotTitle + " - " + maybeName;
  }
  cy.percySnapshot(snapshotTitle, {
    // @ts-ignore
    widths: [cy.state("viewportWidth")],
    // @ts-ignore
    minHeight: cy.state("viewportHeight"),
  });
});

Cypress.Commands.add("Login", () => {
    // 1. Create a random data for our new user.
    const user = generateRandomNewUser();

    // 2. Send sign up API call
    return cy
        .request({
            url: "/api/users/signup",
            method: "POST",
            body: user
        })
        .then(({ body }) => {
            // 3. Send log in API call
            cy.request({
                url: "/api/users/login",
                method: "POST",
                body: {
                    email: user.email,
                    password: user.password
                }
            }).then(({ body }) => {
                // Save received auth token to local storage
                window.localStorage.setItem("authToken", body.authToken);
                return body.data;
            });
        });
});

Cypress.Commands.add("login", (username, password) => {
  cy.request("POST", `${Cypress.env("apiUrl")}/login`, {
                    email: "johndoe@example.com",
                    password: "secret"
    }).then((response) => {
                // Save received auth token to local storage
                document.cookie = "auth._token.user=" + 'Bearer%20' + response.body.meta.token + "; path=/";
                document.cookie = "auth.strategy=user" + "; path=/";
            });
});