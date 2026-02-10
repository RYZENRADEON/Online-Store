export const httpRequest = (form, direction, method, isAsync) => {
    return new Promise((resolve, reject) => {
        const req = new XMLHttpRequest();
        req.open(method, direction, isAsync);

        req.onload = () => {
            if (req.status >= 200 && req.status < 300) {
                resolve(req.responseText);
            } else {
                reject(`HTTP ${req.status}: ${req.statusText}`);
            }
        };

        req.onerror = () => reject('Network error');
        req.send(form);
    });
}