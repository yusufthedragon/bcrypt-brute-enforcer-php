# Bcrypt Brute Enforcer

A simple brute enforcer for Bcrypt algorithm written with PHP.

- [Installation](#installation)
- [Usage Examples](#usage-examples)
  - [Brute Force Plain Dictionary](#brute-force-plain-dictionary)
  - [Brute Force Hashed Dictionary](#brute-force-hashed-dictionary)
  - [Brute Force Mixed Dictionary](#brute-force-mixed-dictionary)
  - [Parsing Bcrypt](#parsing-bcrypt)
- [Test](#test)
- [Contributing](#contributing)

---

## Installation

Just clone this repository with following command:

```bash
git clone https://github.com/yusufthedragon/bcrypt-brute-enforcer-php.git
```

## Usage Examples

### Brute Force Plain Dictionary

```bash
php BruteForcer.php -h ${plainDictionaryFile} ${hashPassword}
```

Note: **You must use single quotes for the hashed password in Linux terminal.**

Example:

```bash
php BruteForcer.php -h plaindictionary.txt '$2y$10$mtLT8Jo.5chBq/vPqgUSQONVdmALRKvSd32PzljD85FIT6sCc3E7y'
```

Result:
```bash
Plain Password: 123456 (line 2)
```

### Brute Force Hashed Dictionary

```bash
php BruteForcer.php -p ${hashedDictionaryFile} ${plainPassword}
```

Example:

```bash
php BruteForcer.php -p hasheddictionary.txt 'password'
```

Result:
```bash
Hashed Password: $2a$10$ApnuWv1YaPVOWMccxk8nUeVbpOXyk6g1HG67KpozOb0AH11nPJqa2 (line 4)
```

### Brute Force Mixed Dictionary

```bash
php BruteForcer.php -f ${hashedDictionaryFile} ${plainDictionaryFile}
```

Example:

```bash
php BruteForcer.php -f hasheddictionary.txt plaindictionary.txt
```

Result:
```bash
$2a$10$FMniiwyewiiQDcPZz26X9eOIchXktWO8kBciEEqmx1qRuOA2m7WRO (line 1) => SecretPassword (line 7)
$2a$10$jx/qQe.pDuX2h0i9QVyzSOQUQ.P.hDdQQoeC1x1pVUNoQw5A/jaUi (line 2) => rahasia123 (line 8)
```

### Parsing Bcrypt

```bash
php HashParser.php ${plainPassword}
```

Example:

```bash
php HashParser.php password
```

Result:

```bash
Prefix: 2y
Log Rounds: 10
Salt: 3US34VoSIRoSGa2HltTkDO
Hash: aK94ruAYt34rwsLUTgLzAf1EjzPj4AG
Bcrypt: $2y$10$3US34VoSIRoSGa2HltTkDOaK94ruAYt34rwsLUTgLzAf1EjzPj4AG
```