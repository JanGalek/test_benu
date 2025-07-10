<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

class Generator
{

    private PrimeNumberFactory $factory;

    public function __construct(private IValidator $validator)
    {
        $this->factory = new PrimeNumberFactory($this->validator);
    }

    /**
     * @return array<int, array<int, int>>
     */
    public function getTable(int $size): array
    {
        $res = [];
        $list = $this->generate($size);
        foreach ($list as $xNumber) {
            foreach ($list as $yNumber) {
                $res[$xNumber->get()][$yNumber->get()] = $xNumber->get() * $yNumber->get();
            }
        }

        return $res;
    }

    /**
     * @return PrimeNumber[]
     */
    public function generate(int $amount): array
    {
        $res = [];
        $i = 2;
        while (count($res) < $amount) {
            try {
                $res[] = $this->factory->create($i);
                $i++;
            } catch (InvalidPrimeNumberException $exception) {
                $i++;

                continue;
            }
        }

        return $res;
    }

}
