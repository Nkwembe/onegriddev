(() => {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated');
        }, false)
    });
})()

$(document).ready(function () {
    $("#tableIssues").hide();
    let issueForm = document.getElementById('issueForm');
    $(issueForm).on('submit', (event) => {
        handleSubmitbtn(issueForm, true);
        event.preventDefault();
        let data = [];
        data['title'] = $("#inputTitle").val();
        data['body'] = $("#inputBody").val();
        data['C'] = $("#inputClient").val();
        data['P'] = $("#inputPriority").val();
        data['T'] = $("#inputType").val();
        if (data.find(d => d.toString().length === 0)) {
            handleSubmitbtn(issueForm, false);
            console.log('all fields are required');
            return;
        } else {
            $.ajax({
                type: "POST",
                url: 'create.php',
                data: Object.assign({}, data),
                success: function (response) {
                    res = JSON.parse(response);
                    if (res.response_code === 201) {
                        getGithubIssues();
                        handleSubmitbtn(issueForm, false);
                        issueForm.reset();
                        issueForm.classList.remove('was-validated');
                    } else {
                        handleSubmitbtn(issueForm, false);
                    }
                },
                error: function (xhr) {
                    console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    handleSubmitbtn(issueForm, false);
                }
            });
        }
    });
    getGithubIssues();
});

function handleSubmitbtn(form, disabled = true) {
    $(form).find('button.btn-primary').prop('disabled', disabled);
    if (disabled) {
        document.getElementById('spinner').classList.add('spinner-border');
    } else {
        document.getElementById('spinner').classList.remove('spinner-border');
    }
}

function getGithubIssues() {
    $.ajax({
        type: "GET",
        url: 'get_github_issues.php',
        success: function (response) {
            let html = "";
            if (response) {
                let issues = JSON.parse(response);
                Array.from(issues).forEach(function (issue, i) {
                    i++;
                    html += "<tr>";
                    html += "<td>" + i + "</td>" + "<td>" + issue.title + "</td>";
                    html += "<td>" + issue.body + "</td>";
                    html += "<td>" + issue.C + "</td>";
                    html += "<td>" + issue.P + "</td>";
                    html += "<td>" + issue.T + "</td>";
                    html += "<td>" + issue.author_association + "</td>";
                    html += "<td>" + issue.state + "</td>";
                    html += "</tr>";
                });
            }
            if (html === '') {
                html = '<tr class="text-center alert alert-warning"><td colspan="10">No issues created yet</td></tr>';
            }
            $("#tableIssues tbody").html(html);
            $("#tableIssues").show();
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    });
}

