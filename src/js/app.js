function calendarToAl(time){
    let EnToAl = [
        {Monday: "E Hënë"}, {Tuesday: "E Martë"}, {Wednesday: "E Mërkurë"},
        {Thursday: "E Enjte"}, {Friday: "E Premte"}, {Saturday: "E Shtunë"},
        {Sunday: "E Dielë"}, {January: "Janar"}, {February: "Shkurt"},
        {March: "Mars"}, {April: "Prill"}, {May: "Maj"}, {June: "Qershor"},
        {July: "Korrik"}, {August: "Gusht"}, {September: "Shtator"},
        {October: "Tetor"}, {November: "Nëntor"}, {December: "Dhjetor"},
    ];
    EnToAl.map((map) => {
        Object.keys(map).forEach((key) => {
            time = time.replace(key, map[key]);
        });
    });
    return time;
}

function alertAndRedirect(text, confirmText, redirectTo){
    Swal.fire({
        title: 'A jeni të sigurtë?',
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmText,
        cancelButtonText: 'Anulo'
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
            });
            window.location.href = redirectTo;
        }
    })
}

