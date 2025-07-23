from typing import List

def find_prime_factors(n):
    x = 2
    factors: list[int] = []

    while x <= n ** 0.5:
        if n % x == 0:
            n /= x
            if int(x) not in factors:
                factors.append(int(x))
        else:
            x += 1
    if int(n) not in factors:
        factors.append(int(n))
    return factors

for i in range(1,61):



