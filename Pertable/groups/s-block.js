AlkaliMetals = RegisterGroup("alkali",
[3,//Li
11,//Na
19,//K
37,//Rb
55,//Cs
87//Fr
],
{
info: "alkaliinfo"
}
);

//============================================================================

AlkaliEarthMetals = RegisterGroup("alkaliearth", [
4,//Be
12,//Mg
20,//Ca
38,//Sr
56,//Ba
88//Ra
]);

//============================================================================

RegisterGroup("selements",
function(i) { return i == 0 || i == 1 || AlkaliMetals.contains(i) || AlkaliEarthMetals.contains(i); }
);