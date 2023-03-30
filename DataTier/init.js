use RunnersDatabase;

db.codes.drop();
db.users.drop();

function generate10DigitHexCode() {
    let hexRef = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
    let result = [];

    for (let n = 0; n < 10; n++) {
        result.push(hexRef[Math.floor(Math.random() * 16)]);
    }
    return result.join('');
}

const codes = [];
const ensureRandomCodes = new Set();
let footballs = 10;

while (codes.length < 100) {
    const code = generate10DigitHexCode();
    if (!ensureRandomCodes.has(code)) {
        ensureRandomCodes.add(code);
        let coupon = "10OFF";
        if (footballs > 0 && Math.floor(Math.random() * 100) == 0) {
            coupon = "FREEBALL";
            footballs--;
        }
        codes.push({ code: code, coupon: coupon, redeemed: false });
    }
}

db.codes.insertMany(codes);

db.codes.findOne({ code: '1234567890' });


codes.push({'_id':90, 'code': '1234567890', 'coupon': 'FREEBALL', 'redeemed': false})
codes.push({'_id':89, 'code': '1234567889', 'coupon': '10OFF', 'redeemed': false})
codes.push({'_id':88, 'code': '1234567898', 'coupon': '10OFF', 'redeemed': true})

db.users.insertOne({});