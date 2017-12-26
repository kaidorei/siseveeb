RegisterGroup("transmet", new Array(
0,//H
0,//He
0,//Li
0,//Be
0,//B
0,//C
0,//N
0,//O
0,//F
0,//Ne
0,//Na
0,//Mg
0,//Al
0,//Si
0,//P
0,//S
0,//Cl
0,//Ar
0,//K
0,//Ca
1,//Sc
1,//Ti
1,//V
1,//Cr
1,//Mn
1,//Fe
1,//Co
1,//Ni
1,//Cu
1,//Zn
0,//Ga
0,//Ge
0,//As
0,//Se
0,//Br
0,//Kr
0,//Rb
0,//Sr
1,//Y
1,//Zr
1,//Nb
1,//Mo
1,//Tc
1,//Ru
1,//Rh
1,//Pd
1,//Ag
1,//Cd
0,//In
0,//Sn
0,//Sb
0,//Te
0,//I
0,//Xe
0,//Cs
0,//Ba
0,//La
0,//Ce
0,//Pr
0,//Nd
0,//Pm
0,//Sm
0,//Eu
0,//Gd
0,//Tb
0,//Dy
0,//Ho
0,//Er
0,//Tm
0,//Yb
0,//Lu
1,//Hf
1,//Ta
1,//W
1,//Re
1,//Os
1,//Ir
1,//Pt
1,//Au
1,//Hg
0,//Tl
0,//Pb
0,//Bi
0,//Po
0,//At
0,//Rn
0,//Fr
0,//Ra
0,//Ac
0,//Th
0,//Pa
0,//U
0,//Np
0,//Pu
0,//Am
0,//Cm
0,//Bk
0,//Cf
0,//Es
0,//Fm
0,//Md
0,//No
0,//Lr
1,//Rf
1,//Db
1,//Sg
1,//Bh
1,//Hs
1,//Mt
1,//Ds
1//Rg
),
{
info: "transmetinfo"
}
);

//=======================================================================

RegisterGroup("rareearths",
function(i) { return Lanthanides.contains(i) || Actinides.contains(i); }
);

//=======================================================================

Lanthanides = RegisterGroup("lanthanides", new Array(
0,//H
0,//He
0,//Li
0,//Be
0,//B
0,//C
0,//N
0,//O
0,//F
0,//Ne
0,//Na
0,//Mg
0,//Al
0,//Si
0,//P
0,//S
0,//Cl
0,//Ar
0,//K
0,//Ca
0,//Sc
0,//Ti
0,//V
0,//Cr
0,//Mn
0,//Fe
0,//Co
0,//Ni
0,//Cu
0,//Zn
0,//Ga
0,//Ge
0,//As
0,//Se
0,//Br
0,//Kr
0,//Rb
0,//Sr
0,//Y
0,//Zr
0,//Nb
0,//Mo
0,//Tc
0,//Ru
0,//Rh
0,//Pd
0,//Ag
0,//Cd
0,//In
0,//Sn
0,//Sb
0,//Te
0,//I
0,//Xe
0,//Cs
0,//Ba
1,//La
1,//Ce
1,//Pr
1,//Nd
1,//Pm
1,//Sm
1,//Eu
1,//Gd
1,//Tb
1,//Dy
1,//Ho
1,//Er
1,//Tm
1,//Yb
1,//Lu
0,//Hf
0,//Ta
0,//W
0,//Re
0,//Os
0,//Ir
0,//Pt
0,//Au
0,//Hg
0,//Tl
0,//Pb
0,//Bi
0,//Po
0,//At
0,//Rn
0,//Fr
0,//Ra
0,//Ac
0,//Th
0,//Pa
0,//U
0,//Np
0,//Pu
0,//Am
0,//Cm
0,//Bk
0,//Cf
0,//Es
0,//Fm
0,//Md
0,//No
0,//Lr
0,//Rf
0,//Db
0,//Sg
0,//Bh
0,//Hs
0,//Mt
0,//Ds
0//Rg
),
{
info: "lanthanidesinfo"
}
);

//======================================================================

Actinides = RegisterGroup("actinides", new Array(
0,//H
0,//He
0,//Li
0,//Be
0,//B
0,//C
0,//N
0,//O
0,//F
0,//Ne
0,//Na
0,//Mg
0,//Al
0,//Si
0,//P
0,//S
0,//Cl
0,//Ar
0,//K
0,//Ca
0,//Sc
0,//Ti
0,//V
0,//Cr
0,//Mn
0,//Fe
0,//Co
0,//Ni
0,//Cu
0,//Zn
0,//Ga
0,//Ge
0,//As
0,//Se
0,//Br
0,//Kr
0,//Rb
0,//Sr
0,//Y
0,//Zr
0,//Nb
0,//Mo
0,//Tc
0,//Ru
0,//Rh
0,//Pd
0,//Ag
0,//Cd
0,//In
0,//Sn
0,//Sb
0,//Te
0,//I
0,//Xe
0,//Cs
0,//Ba
0,//La
0,//Ce
0,//Pr
0,//Nd
0,//Pm
0,//Sm
0,//Eu
0,//Gd
0,//Tb
0,//Dy
0,//Ho
0,//Er
0,//Tm
0,//Yb
0,//Lu
0,//Hf
0,//Ta
0,//W
0,//Re
0,//Os
0,//Ir
0,//Pt
0,//Au
0,//Hg
0,//Tl
0,//Pb
0,//Bi
0,//Po
0,//At
0,//Rn
0,//Fr
0,//Ra
1,//Ac
1,//Th
1,//Pa
1,//U
1,//Np
1,//Pu
1,//Am
1,//Cm
1,//Bk
1,//Cf
1,//Es
1,//Fm
1,//Md
1,//No
1,//Lr
0,//Rf
0,//Db
0,//Sg
0,//Bh
0,//Hs
0,//Mt
0,//Ds
0//Rg
));
