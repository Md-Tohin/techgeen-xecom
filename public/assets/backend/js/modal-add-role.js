// "use strict";
// document.addEventListener("DOMContentLoaded", function (e) {
//     {
//         FormValidation.formValidation(document.getElementById("addRoleForm"), {
//             fields: {
//                 modalRoleName: {
//                     validators: {
//                         notEmpty: { message: "Please enter role name" },
//                     },
//                 },
//             },
//             plugins: {
//                 trigger: new FormValidation.plugins.Trigger(),
//                 bootstrap5: new FormValidation.plugins.Bootstrap5({
//                     eleValidClass: "",
//                     rowSelector: ".col-12",
//                 }),
//                 submitButton: new FormValidation.plugins.SubmitButton(),
//                 autoFocus: new FormValidation.plugins.AutoFocus(),
//             },
//         });
//         const t = document.querySelector("#selectAll"),
//             o = document.querySelectorAll('[type="checkbox"]');
//         t.addEventListener("change", (t) => {
//             o.forEach((e) => {
//                 e.checked = t.target.checked;
//             });
//         });
//     }
// });
