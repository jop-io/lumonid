class Lumonid {
    constructor() {
        this.pool  = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_.";
    }

    generate() {
        let res = "", sum = 0, factor = 2, random, product, index, i;

        for (i = 30; i >= 0; i--) {
            random  = Math.floor(Math.random() * 64);
            product = factor * random;
            sum    += Math.floor(product / 64) + (product % 64);
            factor  = factor === 2 ? 1 : 2;
            res     = this.pool[random] + res;
        }

        index = (64 - (sum % 64)) % 64;
        return res + this.pool[index];
    }

    validate(id) {
        if (!/^[a-zA-Z0-9_\.]{32}$/m.test(id)) {
            return false;
        }

        let i, product, sum = 0, factor = 1;

        for (i = id.length-1; i >= 0; i--) {
            product = factor * this.pool.indexOf(id[i]);
            sum    += Math.floor(product / 64) + (product % 64);
            factor  = factor === 2 ? 1 : 2;
        }

        return sum % 64 === 0;
    }
}
