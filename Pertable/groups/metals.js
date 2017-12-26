RegisterGroup("metals",
function(i) { return !Metalloids.contains(i) && !Nonmetals.contains(i); }
);

//==============================================================================================================

Metalloids = RegisterGroup("metalloids",
[5,//B
14,//Si
32,//Ge
33,//As
51,//Sb
52,//Te
84//Po
],
{
	info: "metalloidsinfo"
}
);

//========================================================================================================

Nonmetals = RegisterGroup("nonmetals",
[
1,//H
2,//He
6,//C
7,//N
8,//O
9,//F
10,//Ne
15,//P
16,//S
17,//Cl
18,//Ar
34,//Se
35,//Br
36,//Kr
53,//I
54,//Xe
85,//At
86//Rn
],
{
info: "nonmetalsinfo"
}
);

//========================================================================================================

RegisterGroup("poormet",
[13,//Al
31,//Ga
49,//In
50,//Sn
81,//Tl
82,//Pb
83//Bi
],
{
info: "poormetinfo"
}
);