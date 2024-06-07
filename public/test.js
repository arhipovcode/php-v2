function adjustDataForChart(data, minPercentage) {
    const total = data.reduce((sum, value) => sum + value, 0);
    const minValue = (total / 100) * minPercentage;
    console.log('total', total)
    console.log('minValue', minValue)

    let adjustedData = [];
    let differenceSum = 0;

    // Преобразование данных
    data.forEach(value => {
        if (value < minValue) {
            differenceSum += (minValue - value);
            adjustedData.push(minValue);
        } else {
            adjustedData.push(value);
        }
    });

    // Корректировка больших значений
    const remainingData = data.filter(value => value >= minValue);
    const remainingSum = remainingData.reduce((sum, value) => sum + value, 0);
    console.log('remainingSum', remainingSum)
    console.log('differenceSum', differenceSum)

    let finalData = [];

    adjustedData.forEach(value => {
        if (value > minValue) {
            const adjustedValue = value - (value / remainingSum) * differenceSum;
            finalData.push(adjustedValue);
        } else {
            finalData.push(minValue);
        }
    });

    return finalData;
}

// Пример использования
const data = [116895, 80163, 35538, 308, 255];
const minPercentage = 2;
const total = data.reduce((sum, value) => sum + value, 0);

const result = adjustDataForChart(data, minPercentage);
const totalResult = result.reduce((sum, value) => sum + value, 0);

console.log('total', total);
console.log('totalResult', totalResult);
console.log("Итоговые значения:", result);
