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

