describe('User Sign-up and Login', function () {
// 	it("should redirect unauthenticated user to signin page", function () {
//     cy.visit("/customer/overview");
//     cy.location("pathname").should("equal", "/login");
//     cy.visualSnapshot("Redirect to SignIn");
//   });

  // it("should access customer/overview page after login", function () {

  // 	const signinPath = "/login";

  // 	cy.location("pathname", { log: false }).then((currentPath) => {
  // 	if (currentPath !== signinPath) {
  // 		cy.visit(signinPath);
  // 		}
  // 	});

  // 	cy.get('input[type=email]').clear().type("johndoe@example.com");
  // 	cy.get('input[type=password]').clear().type("secret");
  // 	cy.get('button[type=submit]').click();
  //   });

  it('login functionality', function () {
    cy.login();
  });
});
