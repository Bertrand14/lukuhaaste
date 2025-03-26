let numberList = document.querySelectorAll("[id^='number-']");

/** Interval
 *
 * Option 1: all progress bar load at same speed
 * => low % will be loaded sooner than high %
 * const interval = 20;
 *
 * Option 2: all progress bar load in same time
 * => low % will load more slowly than high %
 * const interval = 1800 / value; // animation time is 2000ms
 *
 */

numberList.forEach((number, index) => {
    const value = number.textContent;
    let counter = 0;
    const interval = 1800 / value;

    setInterval(() => {
        if (counter == value) {
            clearInterval;
        } else {
            counter += 1;
            number.innerHTML = `${counter}%`;
        }
    }, interval);
});

//
